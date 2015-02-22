<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Riki;

use Riki\Provider\AssetProvider;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\DI\Container;

/**
 * The SimpleRADPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RikiPackage extends AbstractPackage
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
		$container->registerServiceProvider(new AssetProvider);
	}
}
