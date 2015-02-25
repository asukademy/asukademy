<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Logout;

use User\Model\LoginModel;
use User\Model\ProfileModel;
use Windwalker\Core\Authenticate\User;
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
		$user = User::get();

		if ($user->isNull())
		{
			$this->setRedirect(Router::buildHttp('front:page', ['paths' => '']));

			return true;
		}

		$model = new LoginModel;

		$model->logout($user->username);

		$this->setRedirect(Router::buildHttp('front:page', ['paths' => '']), '登出成功', 'success');

		return true;

	}
}
