<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Plans;

use Riki\Asset\ScriptManager;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The PlansHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PlansHtmlView extends BladeHtmlView
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
		$data->items  = $this->model->getItems();
		$data->state  = $this->model->getState();
		$data->stage  = $this->model['stage']->getItem();
		$data->course = $this->model['course']->getItem();

		$data->course_id = $data->state['course.id'];
		$data->stage_id  = $data->state['stage.id'];

		foreach ($data->items as $item)
		{
			$item->price = number_format((double) $item->price, 0, '', '');
			$item->origin_price = number_format((double) $item->origin_price, 0, '', '');
		}

		ScriptManager::load('calendar');
	}
}
