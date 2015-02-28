<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Helper;

/**
 * The DateTimeHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DateTimeHelper
{
	/**
	 * format
	 *
	 * @param string $date
	 * @param string $format
	 * @param bool   $locale
	 *
	 * @return  string
	 */
	public static function format($date, $format = 'Y-m-d H:i:s', $locale = false)
	{
		$tz = $locale ? new \DateTimeZone('Asia/Taipei') : null;

		return (new \DateTime($date, $tz))->format($format);
	}
}
