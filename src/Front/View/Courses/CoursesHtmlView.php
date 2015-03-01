<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Courses;

use Front\View\AbstractFrontHtmlView;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;

/**
 * The CoursesHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CoursesHtmlView extends AbstractFrontHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$data->items           = $this->model->getItems();
		$data->pagination      = $this->model->getPagination();
		$data->currentCategory = $this->model->getCategory();
		$data->cats            = (new DataMapper(Table::CATEGORIES))->findAll();
		$data->state           = $this->model->getState();

		// Prepare item data
		foreach ($data->items as $item)
		{
			$item->link = Router::buildHtml('front:course', ['alias' => $item->alias, 'category_alias' => $item->category_alias]);
		}

		// Separate by Categories
		$categories = [];

		foreach ($data->items as $item)
		{
			// Init category
			 if (empty($categories[$item->catid]))
			 {
				 $categories[$item->catid] = [
					 'data' => new Data([
						 'id' => $item->catid,
						 'title' => $item->category_title,
						 'eng_title' => $item->category_eng_title,
						 'alias' => $item->category_alias,
						 'state' => $item->category_state,
						 'ordering' => $item->category_ordering,
						 'params' => $item->category_params
					 ]),
					 'items' => []
				 ];
			 }

			 $categories[$item->catid]['items'][] = $item;
		}

		$data->categories = $categories;

		// Page Title
		$data->pageTitle = '課程資訊';

		if ($data->currentCategory->notNull())
		{
			$data->pageTitle = $data->currentCategory->title . ' ' . $data->pageTitle;
		}

		if ($this->model->get('list.page') > 1)
		{
			$data->pageTitle .= ' - 第 ' . $data->pageTitle . ' 頁';
		}

		$this->prepareMeta();
	}

	/**
	 * prepareMeta
	 *
	 * @return  void
	 */
	protected function prepareMeta()
	{
		$config = Ioc::getConfig();

		if ($this->data->items[0])
		{
			$config['meta.description'] = $this->data->items[0]->introtext;
		}

		$config['og.image'] = 'https://windspeaker.s3.amazonaws.com/post/asika/2015/03/01/54f315720d36a.jpg';
	}
}
