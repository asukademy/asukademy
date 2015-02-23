<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Plans;

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
		$view        = $this->getView('Plans', 'html');
		$model       = $this->getModel('Plans');
		$stageModel  = $this->getModel('Stage');
		$courseModel = $this->getModel('Course');

		$model['stage.id']  = $this->input->get('stage_id');
		$model['course.id'] = $this->input->get('course_id');

		$stageModel['course.id'] = $this->input->get('course_id');
		$stageModel['item.id']   = $this->input->get('stage_id');

		$courseModel['item.id'] = $this->input->get('course_id');

		$view->setModel($model);
		$view->setModel($stageModel);
		$view->setModel($courseModel);

		return $view->setLayout('edit')->render();
	}
}
