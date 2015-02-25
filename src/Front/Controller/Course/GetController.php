<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Course;

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
		$view = $this->getView('Course', 'html');
		$model = $this->getModel('Course');
//		$stagesModel = $this->getModel('Stages');

		// Default model
		$model['item.id'] = ['alias' => $this->input->getUrl('alias')];

		// Stage model
//		$stagesModel['course.id'] = $model->getItem()->id;

		$view->setModel($model);

		return $view->setLayout('default')->render();
	}
}
