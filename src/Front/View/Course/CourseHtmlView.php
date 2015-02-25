<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Course;

use Front\View\AbstractFrontHtmlView;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

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
	 * @return  void
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$data->item   = $this->model->getItem();
		$data->stages = $this->model->getStages($data->item->id);

		foreach ($data->stages as $stage)
		{
			$stage->time = (new \DateTime($stage->start))->format('Y-m-d');
			$stage->people = count($stage->orders);
			$stage->attendable = $stage->people < $stage->quota;
		}

	}
}
