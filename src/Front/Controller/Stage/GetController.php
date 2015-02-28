<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Stage;

use Admin\Model\StagesModel;
use Front\Model\CourseModel;
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
		$courseModel = new CourseModel;

		$model['item.id'] = $this->input->get('id');

		$view->setModel($model);
		$view->setModel($courseModel);

		return $view->setLayout('default')->render();
	}
}
