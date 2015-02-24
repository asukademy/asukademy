<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Markdown;

use Windwalker\Core\Facade\Facade;
use Windwalker\Ioc;

/**
 * The Markdown class.
 *
 * @method  static  string  defaultTransform()  defaultTransform($text)
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Markdown extends Facade
{
	/**
	 * Property key.
	 *
	 * @var  string
	 */
	protected static $key = 'markdown';

	/**
	 * renderFile
	 *
	 * @param string $file
	 *
	 * @return  string
	 */
	public static function renderFile($file)
	{
		$package = Ioc::getPackage(Ioc::getConfig()->get('route.package'));

		$dir = $package->getDir() . '/Templates/markdown';

		return static::defaultTransform(file_get_contents($dir . '/' . $file));
	}
}
