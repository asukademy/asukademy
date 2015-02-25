<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy;

use Asukademy\Listener\AsukademyListener;
use Asukademy\Listener\AuthoriseListener;
use Asukademy\Listener\ProfilerListener;
use Asukademy\Provider\MarkdownProvider;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\DI\Container;
use Windwalker\Event\Dispatcher;

/**
 * The AsukademyPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AsukademyPackage extends AbstractPackage
{
	/**
	 * registerProviders
	 *
	 * @param Container $container
	 *
	 * @return  void
	 */
	public function registerProviders(Container $container)
	{
		parent::registerProviders($container);

		$container->registerServiceProvider(new MarkdownProvider);
	}

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
		$dispatcher->addListener(new AuthoriseListener);
	}
}
