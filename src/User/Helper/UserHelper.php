<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Helper;

use User\Access\Group;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Router\Router;
use Windwalker\Crypt\CryptHelper;
use Windwalker\Ioc;

/**
 * The UserHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserHelper
{
	/**
	 * createActivationCode
	 *
	 * @param string $username
	 *
	 * @return  string
	 */
	public static function createActivationCode($username)
	{
		$salt = CryptHelper::genRandomBytes(5);

		return md5($salt . $username);
	}

	/**
	 * checkLogin
	 *
	 * @return  boolean
	 */
	public static function checkLogin()
	{
		if (User::get()->notNull())
		{
			return true;
		}

		$session = Ioc::getSession();
		$current = Ioc::getConfig()->get('uri.current');
		$current = base64_encode($current);

		$session->set('login.redirect.url', $current);

		$app = Ioc::getApplication();

		$app->addFlash('請登入以繼續進行操作', 'warning');

		$app->redirect(Router::buildHttp('user:login'));

		return true;
	}

	/**
	 * isLogin
	 *
	 * @param integer $user
	 *
	 * @return  bool
	 */
	public static function isLogin($user = null)
	{
		return !User::get($user)->isNull();
	}

	/**
	 * isAdmin
	 *
	 * @param int $pk
	 *
	 * @return  bool
	 */
	public static function isAdmin($pk = null)
	{
		$user = User::get($pk);

		if (!$user->isGuest())
		{
			return false;
		}

		return $user->group === Group::ADMIN;
	}
}
