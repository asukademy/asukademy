<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Helper;

/**
 * The OrderHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderHelper
{
	/**
	 * getStateTitle
	 *
	 * @param integer $state
	 *
	 * @return  string
	 */
	public static function getStateTitle($state)
	{
		$states = [
			-1 => '已取消',
			0 => '審核中',
			1 => '待繳費',
			2 => '報名成功'
		];

		if (array_key_exists($state, $states))
		{
			return $states[$state];
		}

		return '未知狀態';
	}
}
