<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker;

use Windwalker\Profiler\Profiler;

/**
 * The Ioc class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Ioc extends \Windwalker\Core\Ioc
{
	/**
	 * getConfig
	 *
	 * @return  Profiler
	 */
	public static function getProfiler()
	{
		return static::get('system.profiler');
	}
}
