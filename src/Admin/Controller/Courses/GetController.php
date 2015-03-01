<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Courses;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Ioc;

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
		$view = $this->getView('Courses', 'html');
		$model = $this->getModel('Courses');

		$model['list.page']     = $page = $this->input->getInt('page', 1);
		$model['list.limit']    = 25;
		$model['list.start']    = ($model['list.page'] - 1) * $model['list.limit'];
		$model['list.search']   = $this->input->getString('q');
		$model['list.ordering'] = 'category.ordering, course.ordering';

		$view->setModel($model);

		return $view->setLayout('default')->render();
	}
}
