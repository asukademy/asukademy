<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Provider;

use Michelf\MarkdownExtra;
use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;

/**
 * The MarkdownProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class MarkdownProvider implements ServiceProviderInterface
{
	/**
	 * Registers the service provider with a DI container.
	 *
	 * @param   Container $container The DI container.
	 *
	 * @return  void
	 */
	public function register(Container $container)
	{
		$closure = function(Container $container)
		{
			return new MarkdownExtra;
		};

		$container->getParent()->share('markdown', $closure);
	}
}
