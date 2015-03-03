<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin;

use Admin\Listener\AuthoriseListener;
use Admin\S3\S3Provider;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\DI\Container;
use Windwalker\Event\Dispatcher;

/**
 * The AdminPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AdminPackage extends AbstractPackage
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

		$dispatcher->addListener(new AuthoriseListener);
	}

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

		$container->registerServiceProvider(new S3Provider);
	}
}
