<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Login;

use User\Helper\UserHelper;
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
		if (UserHelper::isLogin())
		{
			$this->setRedirect(Router::buildHttp('user:profile'));

			return true;
		}

		$view = $this->getView('Login', 'html');
		$model = $this->getModel('Login');

		$view->setModel($model);

		$view['return'] = $this->input->getBase64('return');

		return $view->setLayout('default')->render();
	}
}
