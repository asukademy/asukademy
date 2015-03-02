<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Activation;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;

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
		$model = $this->getModel('Activation');
		$token = $this->input->get('token');

		try
		{
			$model->activate($token);
		}
		catch (\Exception $e)
		{
			$this->setRedirect(Router::buildHttp('user:login'), $e->getMessage(), 'warning');

			return false;
		}

		$this->setRedirect(Router::buildHttp('user:login'), '驗證成功，請由此登入', 'success');

		return true;

		// return $view->setLayout('default')->render();
	}
}
