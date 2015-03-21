<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Helper;

use Windwalker\Core\Ioc;
use Windwalker\Data\Data;

/**
 * The PreviewHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PreviewHelper
{
	/**
	 * getCourseToken
	 *
	 * @param string $id
	 * @param string $alias
	 *
	 * @return string
	 */
	public static function getCourseToken($id, $alias)
	{
		return static::getToken($id . $alias);
	}

	/**
	 * getStageToken
	 *
	 * @param string $id
	 * @param string $courseId
	 *
	 * @return string
	 */
	public static function getStageToken($id, $courseId)
	{
		return static::getToken($id . $courseId);
	}

	/**
	 * checkCourseToken
	 *
	 * @param Data $course
	 *
	 * @return  boolean
	 */
	public static function checkCourseToken(Data $course)
	{
		$input = Ioc::getInput();

		return (bool) $input->get(static::getCourseToken($course->id, $course->alias));
	}

	/**
	 * checkCourseToken
	 *
	 * @param Data $stage
	 *
	 * @return bool
	 */
	public static function checkStageToken(Data $stage)
	{
		$input = Ioc::getInput();

		return (bool) $input->get(static::getStageToken($stage->id, $stage->course_id));
	}

	/**
	 * getToken
	 *
	 * @param string $string
	 *
	 * @return  string
	 */
	public function getToken($string)
	{
		return strtoupper(substr(md5($string . 'Asukademy-qwerasdf'), 0, 10));
	}
}
