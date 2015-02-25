<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Listener;

use User\Helper\UserHelper;
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
	public function onBeforeRender(Event $event)
	{
		$route = Ioc::getConfig()->extract('route');

		if ($route['package'] == 'user' && $route['matched'] != 'user:login')
		{
			UserHelper::checkLogin();
		}

		if ($route['extra.auth'])
		{
			UserHelper::checkLogin();
		}
	}
}
