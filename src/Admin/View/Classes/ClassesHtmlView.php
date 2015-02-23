<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Classes;

use Riki\Asset\ScriptManager;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The ClassesHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ClassesHtmlView extends BladeHtmlView
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

		ScriptManager::load('calendar', '.date-picker', 'YYYY-MM-DD');
	}
}
