<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Helper;

use Windwalker\Core\Router\Router;

/**
 * The ThumbHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ThumbHelper
{
	/**
	 * resize
	 *
	 * @param string $url
	 * @param int    $width
	 * @param int    $height
	 *
	 * @return  string
	 */
	public static function resize($url, $width = 75, $height = 75)
	{
		return Router::buildHtml('front:image', ['url' => urlencode($url), 'w' => $width, 'h' => $height]);
	}
}
