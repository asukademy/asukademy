<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\S3;

use Windwalker\Core\Facade\Facade;

/**
 * The S3Helper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class S3Helper extends Facade
{
	/**
	 * Property key.
	 *
	 * @var  string
	 */
	protected static $key = 's3';

	protected static $host = '';

	/**
	 * put
	 *
	 * @param string $src
	 * @param string $dest
	 *
	 * @return  boolean
	 */
	public static function put($src, $dest)
	{
		return static::putObject(\S3::inputFile($src, false), 'asukademy', $dest, \S3::ACL_PUBLIC_READ);
	}
}
