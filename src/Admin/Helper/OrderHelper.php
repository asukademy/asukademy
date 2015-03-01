<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Helper;

use Windwalker\Data\Data;

/**
 * The OrderHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderHelper
{
	const STATE_CANCELED     = -1;
	const STATE_PENDING      = 0;
	const STATE_WAIT_PAY     = 1;
	const STATE_PAID_SUCCESS = 2;
	const STATE_PROCESSING   = 3;
	const STATE_END          = 4;

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
			static::STATE_PAID_SUCCESS => '報名成功',
			static::STATE_PROCESSING => '課程進行中',
			static::STATE_END => '課程結束',
		];

		if (array_key_exists($state, $states))
		{
			return $states[$state];
		}

		return '未知狀態';
	}

	/**
	 * setExtraState
	 *
	 * @param Data $order
	 *
	 * @return  Data
	 */
	public static function setExtraStateList(Data $order)
	{
		if ($order->stage_end)
		{
			$end = new \DateTime($order->stage_end);
		}
		else
		{
			$end = new \DateTime($order->stage_start);
		}

		$date = new \DateTime($order->stage_start);

		$now = new \DateTime;

		if ($now > $date)
		{
			$order->state = OrderHelper::STATE_PROCESSING;
		}

		if ($now > $end)
		{
			$order->state = OrderHelper::STATE_END;
		}

		return $order;
	}

	/**
	 * setExtraState
	 *
	 * @param Data $order
	 *
	 * @return  Data
	 */
	public static function setExtraState(Data $order)
	{
		if ($order->stage->end)
		{
			$end = new \DateTime($order->stage->end);
		}
		else
		{
			$end = new \DateTime($order->stage->start);
		}

		$date = new \DateTime($order->stage->start);

		$now = new \DateTime;

		if ($now > $date)
		{
			$order->state = OrderHelper::STATE_PROCESSING;
		}

		if ($now > $end)
		{
			$order->processing = OrderHelper::STATE_END;
		}

		return $order;
	}
}
