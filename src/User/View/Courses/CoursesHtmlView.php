<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\View\Courses;

use Admin\Helper\OrderHelper;
use Front\View\AbstractFrontHtmlView;

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

		$data->items = $this->model->getItems();
		$data->pagination = $this->model->getPagination();

		// State
		foreach ($data->items as $item)
		{
			OrderHelper::setExtraStateList($item);
		}
	}
}
