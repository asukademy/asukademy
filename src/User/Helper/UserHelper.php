<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Helper;

use Windwalker\Crypt\CryptHelper;

/**
 * The UserHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserHelper
{
	/**
	 * createActivationCode
	 *
	 * @param string $username
	 *
	 * @return  string
	 */
	public static function createActivationCode($username)
	{
		$salt = CryptHelper::genRandomBytes(5);

		return md5($salt . $username);
	}
}
