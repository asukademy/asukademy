<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Data;

use User\Access\Group;
use Windwalker\Core\Authenticate\UserDataInterface;
use Windwalker\Data\Data;

/**
 * The UserData class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserData extends Data implements UserDataInterface
{
	/**
	 * isLogin
	 *
	 * @return  boolean
	 */
	public function isGuest()
	{
		return !count($this);
	}

	/**
	 * notLogin
	 *
	 * @return  boolean
	 */
	public function isMember()
	{
		return !$this->isGuest();
	}

	/**
	 * isAdmin
	 *
	 * @return  boolean
	 */
	public function isAdmin()
	{
		return $this->group === Group::ADMIN;
	}

	/**
	 * toArray
	 *
	 * @return  array
	 */
	public function dump()
	{
		return iterator_to_array($this);
	}
}
