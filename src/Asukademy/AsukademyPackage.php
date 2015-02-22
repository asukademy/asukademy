<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy;

use Asukademy\Listener\AsukademyListener;
use Asukademy\Listener\ProfilerListener;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Event\Dispatcher;

/**
 * The AsukademyPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AsukademyPackage extends AbstractPackage
{
	/**
	 * registerListeners
	 *
	 * @param Dispatcher $dispatcher
	 *
	 * @return  void
	 */
	public function registerListeners(Dispatcher $dispatcher)
	{
		parent::registerListeners($dispatcher);

		$dispatcher->addListener(new AsukademyListener);
		$dispatcher->addListener(new ProfilerListener);
	}
}
