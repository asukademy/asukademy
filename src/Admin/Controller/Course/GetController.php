<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Course;

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
		$view        = $this->getView('Course', 'html');
		$model       = $this->getModel('Course');
		$stagesModel = $this->getModel('Stages');

		// Set course state
		$model['item.id'] = $this->input->get('id');

		// Set stages state
		$stagesModel['list.ordering'] = 'stage.start DESC';
		$stagesModel['filter.course_id'] = $model['item.id'];

		$view->setModel($model);
		$view->setModel($stagesModel);

		return $view->setLayout('edit')->render();
	}
}
