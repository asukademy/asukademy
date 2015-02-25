<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User;

use User\Handler\UserHandler;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Package\AbstractPackage;

/**
 * The UserPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserPackage extends AbstractPackage
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	public function initialise()
	{
		parent::initialise();

		User::setHandler(new UserHandler);
	}
}
