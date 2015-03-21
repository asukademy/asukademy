<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Helper;

/**
 * The ClassHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ClassHelper
{
	/**
	 * getTimeByID
	 *
	 * @param string $id
	 *
	 * @return  string
	 */
	public static function getTimeByID($id)
	{
		$id = explode('.', $id);

		$min = isset($id[1]) ? '30' : '00';

		$hr = sprintf('%02d', $id[0]);

		return $hr . ':' . $min;
	}

	/**
	 * getIDByTime
	 *
	 * @param string $time
	 *
	 * @return  string
	 */
	public static function getIDByTime($time)
	{
		$time = explode(':', $time);

		if (!isset($time[1]))
		{
			$time[1] = '00';
		}

		return (int) $time[0] . ($time[1] == '30' ? '.5' : '');
	}
}
