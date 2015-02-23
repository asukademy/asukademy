<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Crud;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Ioc;

/**
 * The NewController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class NewController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$name = $this->input->get('name');

		$get = $this->input->get->getArray();

		$session = Ioc::getSession();

		$session->remove($name . '.edit.data');

		$this->setRedirect(Router::buildHttp('admin:' . $name, $this->input->getVar('queries')));

		return true;
	}
}
