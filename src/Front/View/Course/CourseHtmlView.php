<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Course;

use Asukademy\Helper\PreviewHelper;
use Front\View\AbstractFrontHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\DataMapper\RelationDataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;
use Windwalker\Uri\Uri;

/**
 * The CourseHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseHtmlView extends AbstractFrontHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @throws \Exception
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$data->item   = $this->model->getItem();

		$this->checkAccess($data);

		$data->stages = $this->model->getStages($data->item->id);
		$data->category = (new DataMapper(Table::CATEGORIES))->findOne(['id' => $data->item->catid]);

		foreach ($data->stages as $stage)
		{
			$stage->time = (new \DateTime($stage->start))->format('Y-m-d');
			$stage->people = $stage->total;
			$stage->attendable = $stage->quota ? $stage->total < $stage->quota : true;
		}

		// Recommends
		$this->model['courses']->set('list.ordering', 'RAND()');
		$this->model['courses']->set('list.limit', 5);
		$this->model['courses']->set('filter.category_alias', $data->category->alias);
		$data->recommends = $this->model['courses']->getItems();

		foreach ($data->recommends as $item)
		{
			$item->link = Router::buildHtml('front:course', ['alias' => $item->alias, 'category_alias' => $item->category_alias]);
		}

		// Randoms
		$this->model['courses']->reset();
		$this->model['courses']->set('list.ordering', 'RAND()');
		$this->model['courses']->set('list.limit', 7);
		$data->randoms = $this->model['courses']->getItems();

		foreach ($data->randoms as $item)
		{
			$item->link = Router::buildHtml('front:course', ['alias' => $item->alias, 'category_alias' => $item->category_alias]);
		}

		// Tutors
		$tutorMapper = new RelationDataMapper('tutor', Table::TUTORS);
		$tutorMapper->addTable('map', Table::TUTOR_COURSE_MAPS, 'tutor.id = map.tutor_id')
			->addTable('course', Table::COURSES, 'course.id = map.course_id');

		$data->tutors = $tutorMapper->find(['course.id' => $data->item->id]);

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

		$config['meta.description'] = $this->data->item->introtext;

		$config['og.image'] = $this->data->item->image;
	}

	/**
	 * checkAccess
	 *
	 * @param Data $data
	 *
	 * @return  void
	 *
	 * @throws \Exception
	 */
	protected function checkAccess($data)
	{
		// Access
		if ($data->item->state < 1)
		{
			if (User::get()->isAdmin() || PreviewHelper::checkStageToken($data->item))
			{
				$uri = new Uri(\Riki\Uri\Uri::current());
				$uri->setVar(PreviewHelper::getStageToken($data->item->id, $data->item->course_id), 1);

				$msg = [
					'此課程尚未發布，目前是預覽狀態',
					'分享預覽網址: ' . $uri
				];

				Ioc::getApplication()
					->addFlash($msg, 'warning')
					->set('meta.robots', 'noindex, nofollow');
			}
			else
			{
				throw new \Exception('找不到頁面', 404);
			}
		}
	}
}
