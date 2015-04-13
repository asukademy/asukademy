<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Listener;

use Windwalker\Core\Ioc;
use Windwalker\Event\Event;
use Windwalker\Filesystem\Folder;

/**
 * The UserListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserListener
{
	/**
	 * onUserAfterLogin
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onUserAfterLogin(Event $event)
	{
		$options = $event['options'];

		$remember = $options['remember'];

		if ($remember)
		{
			$session = Ioc::getSession();

			setcookie(session_name(), $_COOKIE[session_name()], time() + 60 * 60 * 24 * 100, '/', Ioc::getConfig()->get('uri.host'), false, true);
		}
	}

	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
//		if (isset($_COOKIE[session_name()]))
//		{
//			session_id($_COOKIE[session_name()]);
//		}

		// @see http://natesilva.tumblr.com/post/250569350/php-sessions-timeout-too-soon-no-matter-how-you

		// Session lifetime of 3 hours
		// ini_set('session.gc_maxlifetime', 10800);

		// Enable session garbage collection with a 1% chance of
		// running on each session_start()
		ini_set('session.gc_probability', 1);
		ini_set('session.gc_divisor', 100);

		/*
		 * Our own session save path; it must be outside the
		 * default system save path so Debian's cron job doesn't
		 * try to clean it up. The web server daemon must have
		 * read/write permissions to this directory.
		 */
		session_save_path(WINDWALKER_ROOT . '/sessions');
	}
}
