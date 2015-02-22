<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Helper;

/**
 * The GridHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class GridHelper
{
	/**
	 * getBooleanIcon
	 *
	 * @param integer $value
	 *
	 * @return  string
	 */
	public static function getBooleanIcon($value)
	{
		$icon = $value ? 'ok-sign' : 'remove-sign';

		$color = $value ? 'text-success' : 'text-danger';

		return '<span class="glyphicon glyphicon-' . $icon . ' ' . $color . '"></span>';
	}
}
