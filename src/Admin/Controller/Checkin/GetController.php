<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Checkin;

use Windwalker\Core\Controller\Controller;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$view = $this->getView('Checkin', 'html');
		$model = $this->getModel('Orders');
		$stageModel  = $this->getModel('Stage');
		$courseModel = $this->getModel('Course');

		$model['filter.stage_id']  = $this->input->get('stage_id');
		$model['stage.id']  = $this->input->get('stage_id');
		$model['course.id'] = $this->input->get('course_id');
		$model['list.ordering'] = 'order.id ASC';

		$stageModel['course.id'] = $this->input->get('course_id');
		$stageModel['item.id']   = $this->input->get('stage_id');

		$courseModel['item.id'] = $this->input->get('course_id');

		$view->setModel($model);
		$view->setModel($stageModel);
		$view->setModel($courseModel);

		return $view->setLayout('edit')->render();
	}
}
