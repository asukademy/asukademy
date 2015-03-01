<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Categories;

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
		if (!$page && $session->get('admin.' . $this->getName() . '.current.page'))
		{
			$this->setRedirect(Router::buildHttp('admin:' . $this->getName(), ['page' => $session->get('admin.' . $this->getName() . '.current.page')]));

			return true;
		}

		$view = $this->getView($this->getName(), 'html');
		$model = $this->getModel($this->getName());

		$view->setModel($model);

		$model['list.page']     = $page = $this->input->getInt('page', 1);
		$model['list.limit']    = 25;
		$model['list.start']    = ($model['list.page'] - 1) * $model['list.limit'];
		$model['list.search']   = $this->input->getString('q');
		$model['list.ordering'] = 'category.ordering';

		$session->set('admin.' . $this->getName() . '.current.page', $page);

		$view->setModel($model);

		return $view->setLayout('default')->render();
	}
}
