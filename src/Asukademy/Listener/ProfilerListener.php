<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Listener;

use Windwalker\Ioc;
use Windwalker\Event\Event;
use Windwalker\Profiler\Profiler;

/**
 * The ProfilerListaner class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfilerListener
{
	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
		Ioc::getContainer()->share('system.profiler', new Profiler('system'));
	}
}
