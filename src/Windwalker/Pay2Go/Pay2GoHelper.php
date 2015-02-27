<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go;

/**
 * The Pay2GoHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class Pay2GoHelper
{
	/**
	 * createCheckValue
	 *
	 * @param array  $data
	 * @param string $key
	 * @param string $iv
	 *
	 * @return  string
	 */
	public static function createCheckValue(array $data, $key, $iv)
	{
		$require = array(
			'MerchantID',
			'TimeStamp',
			'MerchantOrderNo',
			'Version',
			'Amt',
		);

		foreach ($require as $name)
		{
			if (empty($data[$name]))
			{
				throw new \InvalidArgumentException(sprintf('Missing %s value.', $name));
			}
		}

		$merArray = array(
			'MerchantID'     => $data['MerchantID'],
			'TimeStamp'      => $data['TimeStamp'],
			'MerchantOrderNo'=> $data['MerchantOrderNo'],
			'Version'        => $data['Version'],
			'Amt'            => $data['Amt'],
		);

		ksort($merArray);

		$checkMerstr = http_build_query($merArray);

		$CheckValueSTR = "HashKey=$key&$checkMerstr&HashIV=$iv";

		return strtoupper(hash("sha256", $CheckValueSTR));
	}

	/**
	 * createCheckCode
	 *
	 * @param array  $data
	 * @param string $key
	 * @param string $iv
	 *
	 * @return  string
	 */
	public static function createCheckCode(array $data, $key, $iv)
	{
		$require = array(
			'MerchantID',
			'MerchantOrderNo',
			'TradeNo',
			'Amt',
		);

		foreach ($require as $name)
		{
			if (empty($data[$name]))
			{
				throw new \InvalidArgumentException(sprintf('Missing %s value.', $name));
			}
		}

		$merArray = array(
			'MerchantID'     => $data['MerchantID'],
			'MerchantOrderNo'=> $data['MerchantOrderNo'],
			'TradeNo'        => $data['TradeNo'],
			'Amt'            => $data['Amt'],
		);

		ksort($merArray);

		$checkMerstr = http_build_query($merArray);

		$CheckValueSTR = "HashIV=$iv&$checkMerstr&HashKey=$key";

		return strtoupper(hash("sha256", $CheckValueSTR));
	}
}
