<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Stage;

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
		$view = $this->getView('Stage', 'html');
		$model = $this->getModel('Stage');

		$model['item.id'] = $this->input->get('id');
		$model['course.id'] = $this->input->get('course_id');

		$view->setModel($model);

		// Set request
		$view['course_id'] = $this->input->get('course_id');
		$view['stage_id'] = $this->input->get('id');

		return $view->setLayout('edit')->render();
	}
}
