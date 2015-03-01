<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Listener;

use User\Helper\UserHelper;
use Windwalker\Event\Event;
use Windwalker\Ioc;
use Windwalker\Session\Session;

/**
 * The AuthoriseListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthoriseListener
{
	public function onAfterRouting(Event $event)
	{
	}

	/**
	 * onBeforeRender
	 *
	 * @param Event $event
	 */
	public function onBeforeRender(Event $event)
	{
	}
}
