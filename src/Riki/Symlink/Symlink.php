<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Riki\Symlink;

use Windwalker\Environment\ServerHelper;

/**
 * The Symlink class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Symlink
{
	/**
	 * make
	 *
	 * @param string $src
	 * @param string $dest
	 *
	 * @return  string
	 */
	public function make($src, $dest)
	{
		$windows = ServerHelper::isWindows();

		$src    = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $src);
		$dest = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $dest);

		if ($windows)
		{
			return exec("mklink /D {$dest} {$src}");
		}
		else
		{
			return exec("ln -s {$src} {$dest}");
		}
	}
}
