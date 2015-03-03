<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\S3;

use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Ioc;

/**
 * The S3Provider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class S3Provider implements ServiceProviderInterface
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
			return new \S3(
				$container->get('app')->get('amazon.access_key'),
				$container->get('app')->get('amazon.secret_key')
			);
		};

		Ioc::getContainer()->share('s3', $closure);
	}
}
 