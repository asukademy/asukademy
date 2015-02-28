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
	const STATE_CANCELED = -1;
	const STATE_PENDING = 0;
	const STATE_WAIT_PAY = 1;
	const STATE_PAID_SUCCESS = 2;

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
			static::STATE_CANCELED => '已取消',
			static::STATE_PENDING  => '審核中',
			static::STATE_WAIT_PAY => '待繳費',
			static::STATE_PAID_SUCCESS => '報名成功'
		];

		if (array_key_exists($state, $states))
		{
			return $states[$state];
		}

		return '未知狀態';
	}
}
