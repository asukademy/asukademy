<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Login;

use User\Model\LoginModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$model = new LoginModel;

		$user = $this->input->getVar('user');

		try
		{
			$model->login($user['username'], $user['password']);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('user:login'), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('user:login'), '因系統問題造成的登入失敗，請聯絡網站管理員', 'warning');

			return false;
		}

		$this->setRedirect('/', '登入成功', 'success');

		return true;
	}
}
