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
class EditController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$name = $this->input->get('name');
		$id = $this->input->get('id');

		$session = Ioc::getSession();

		$session->remove($name . '.edit.data' . $id);

		$this->setRedirect(Router::buildHttp('admin:' . $name, ['id' => $id]));

		return true;
	}
}
