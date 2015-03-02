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
	const FORMAT_YMD     = 'Y-m-d';
	const FORMAT_YMD_HI  = 'Y-m-d H:i';
	const FORMAT_YMD_HIS = 'Y-m-d H:i:s';

	const TIMEZONE_UTC    = 'UTC';
	const TIMEZONE_TAIPEI = 'Asia/Taipei';

	/**
	 * format
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return  string
	 */
	public static function format($date, $format = self::FORMAT_YMD_HIS)
	{
		return (new \DateTime($date))->format($format);
	}

	/**
	 * convert
	 *
	 * @param string $date
	 * @param string $from
	 * @param string $to
	 * @param string $format
	 *
	 * @return  string
	 */
	public static function convert($date, $from = self::TIMEZONE_UTC, $to = self::TIMEZONE_TAIPEI, $format = self::FORMAT_YMD_HIS)
	{
		$from = new \DateTimeZone($from);
		$to   = new \DateTimeZone($to);

		$date = new \DateTime($date, $from);

		$date->setTimezone($to);

		return $date->format($format);
	}

	/**
	 * toUTC
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return  string
	 */
	public static function toUTC($date, $format = self::FORMAT_YMD_HIS)
	{
		return static::convert($date, static::TIMEZONE_TAIPEI, static::TIMEZONE_UTC, $format);
	}

	/**
	 * toTaipei
	 *
	 * @param string $date
	 * @param string $format
	 *
	 * @return  string
	 */
	public static function toTaipei($date, $format = self::FORMAT_YMD_HIS)
	{
		return static::convert($date, static::TIMEZONE_UTC, static::TIMEZONE_TAIPEI, $format);
	}
}
