<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Listener;

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
	 * onBeforeRender
	 *
	 * @param Event $event
	 */
	public function onBeforeRender(Event $event)
	{
		$config = Ioc::getConfig();

		if ($config->get('route.package') != 'admin')
		{
			return;
		}

		// Check user here.
	}
}
