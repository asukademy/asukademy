<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Courses;

use Front\Model\CoursesModel;
use Front\Model\OrdersModel;
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
		$session = Ioc::getSession();
		$page = $this->input->getInt('page');

		// Remember page
		if (!$page && $session->get('courses.current.page'))
		{
			$this->setRedirect(Router::buildHttp('user:courses', ['page' => $session->get('courses.current.page')]));

			return true;
		}

		$view = $this->getView('Courses', 'html');
		$model = new OrdersModel;

		$model['list.page']     = $page = $this->input->getInt('page', 1);
		$model['list.limit']    = 15;
		$model['list.start']    = ($model['list.page'] - 1) * $model['list.limit'];
		$model['list.search']   = $this->input->getString('q');
		$model['list.ordering'] = 'stage.start desc';
//		$model['list.search']   = $this->input->getString('q');
//		$model['filter.category_alias'] = urldecode($this->input->getString('category_alias'));

		$session->set('courses.current.page', $page);

		$view->setModel($model);

		return $view->setLayout('default')->render();
	}
}
