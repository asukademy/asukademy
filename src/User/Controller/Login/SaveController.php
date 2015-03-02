<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Login;

use User\Helper\UserHelper;
use User\Model\LoginModel;
use Windwalker\Authenticate\Authenticate;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;

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
		if (UserHelper::isLogin())
		{
			$this->setRedirect(Router::buildHttp('user:profile'));

			return true;
		}

		$model = new LoginModel;
		$session = Ioc::getSession();

		$user = $this->input->getVar('user');
		$user = new Data($user);

		$return = $session->get('login.redirect.url') ? : $this->input->getBase64('return');

		$return = $return ? base64_decode($return) : Router::buildHttp('user:courses');

		$session->remove('login.redirect.url');

		try
		{
			if (!$model->login($user['username'], $user['password'], $user['remember']))
			{
				$error = $model['errors'];

				if ($error['database'] === Authenticate::EMPTY_CREDENTIAL)
				{
					throw new ValidFailException('請輸入帳密');
				}
				elseif ($error['database'] === Authenticate::INVALID_CREDENTIAL)
				{
					throw new ValidFailException('密碼不正確');
				}
				elseif ($error['database'] === Authenticate::USER_NOT_FOUND)
				{
					throw new ValidFailException('沒有此帳號');
				}

				throw new ValidFailException('登入失敗');
			}

			$user = User::get();

			$user->last_login = (new \DateTime('now'))->format('Y-m-d H:i:s');

			User::save($user);
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

		$this->setRedirect($return, '登入成功', 'success');

		return true;
	}
}
