<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Listener;

use User\Helper\UserHelper;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Event\Event;
use Windwalker\Ioc;

/**
 * The AuthoriseListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthoriseListener
{
	/**
	 * onBeforeExecute
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterRouting(Event $event)
	{
		$route = Ioc::getConfig()->extract('route');

		if ($route['package'] == 'admin')
		{
			UserHelper::checkLogin();

			if (!User::get()->isAdmin())
			{
				throw new \Exception('找不到頁面', 404);
			}
		}

		if ($route['package'] == 'user' && $route['matched'] != 'user:login' && $route['matched'] != 'user:registration'
			&& $route['metched'] != 'user:activation')
		{
			UserHelper::checkLogin();
		}

		if ($route['extra.auth'])
		{
			UserHelper::checkLogin();
		}
	}

	public function onUserBeforeLogin(Event $event)
	{
		$credential = $event['credential'];

		$user = User::get(['username' => $credential->username]);

		if ($user->isNull())
		{
			return;
		}

		if ($user->activation)
		{
			throw new ValidFailException('使用者尚未通過 Email 驗證');
		}

		if (!$user->state)
		{
			throw new ValidFailException('使用者尚未啟用');
		}
	}
}
