<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Provider;

use Windwalker\DI\Container;
use Windwalker\DI\ServiceProviderInterface;

/**
 * The SwiftMailerProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SwiftMailerProvider implements ServiceProviderInterface
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
			$config = $container->get('system.config');

			return \Swift_SmtpTransport::newInstance($config['smtp.host'], $config['smtp.port'], $config['smtp.type'])
				->setUsername($config['smtp.username'])
				->setPassword($config['smtp.password']);
		};

		$container->share('mailer', $closure);
	}
}
