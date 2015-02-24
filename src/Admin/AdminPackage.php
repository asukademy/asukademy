<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin;

use Admin\Listener\AuthoriseListener;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Event\Dispatcher;

/**
 * The AdminPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AdminPackage extends AbstractPackage
{
	public function registerListeners(Dispatcher $dispatcher)
	{
		parent::registerListeners($dispatcher);

		$dispatcher->addListener(new AuthoriseListener);
	}
}
