<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go;

/**
 * The Pay2GoReceiver class.
 *
 * @method  string          getMerchantID()  getMerchantID()
 * @method  Pay2GoReceiver  setMerchantID()  setMerchantID($value)
 * @method  string          getCheckCode()  getCheckCode()
 * @method  Pay2GoReceiver  setCheckCode()  setCheckCode($value)
 * @method  string          getRespondType()  getRespondType()
 * @method  Pay2GoReceiver  setRespondType()  setRespondType($value)
 * @method  string          getMerchantOrderNo()  getMerchantOrderNo()
 * @method  Pay2GoReceiver  setMerchantOrderNo()  setMerchantOrderNo($value)
 * @method  string          getTimeStamp()  getTimeStamp()
 * @method  Pay2GoReceiver  setTimeStamp()  setTimeStamp($value)
 * @method  string          getVersion()  getVersion()
 * @method  Pay2GoReceiver  setVersion()  setVersion($value)
 * @method  string          getAmt()  getAmt()
 * @method  Pay2GoReceiver  setAmt()  setAmt($value)
 * @method  string          getItemDesc()  getItemDesc()
 * @method  Pay2GoReceiver  setItemDesc()  setItemDesc($value)
 * @method  string          getExpireDate()  getExpireDate()
 * @method  Pay2GoReceiver  setExpireDate()  setExpireDate($value)
 * @method  Pay2GoReceiver  setReturnURL()  setReturnURL($value)
 * @method  string          getReturnURL()  getReturnURL()
 * @method  string          getNotifyURL()  getNotifyURL()
 * @method  Pay2GoReceiver  setNotifyURL()  setNotifyURL($value)
 * @method  Pay2GoReceiver  setCustomerURL()  setCustomerURL($value)
 * @method  string          getCustomerURL()  getCustomerURL()
 * @method  string          getEmail()  getEmail()
 * @method  Pay2GoReceiver  setEmail()  setEmail($value)
 * @method  string          getLoginType()  getLoginType()
 * @method  Pay2GoReceiver  setLoginType()  setLoginType($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class Pay2GoReceiver extends AbstractDataHolder
{
	protected $data = array(
		'Version' => '1.1'
	);

	/**
	 * Property hashKey.
	 *
	 * @var  string
	 */
	protected $hashKey;

	/**
	 * Property hashIV.
	 *
	 * @var  string
	 */
	protected $hashIV;


	/**
	 * Class init
	 *
	 * @param string $MerchantID
	 * @param string $hashKey
	 * @param string $hashIV
	 */
	public function __construct($MerchantID = null, $hashKey = null, $hashIV = null)
	{
		$this->hashKey = $hashKey;
		$this->hashIV = $hashIV;
		$this->setMerchantID($MerchantID);
	}

	/**
	 * validate
	 *
	 * @return  boolean
	 */
	public function validate()
	{
		echo $code = Pay2GoHelper::createCheckCode($this->data, $this->getHashKey(), $this->getHashIV());

		return $code == $this->getCheckCode();
	}

	/**
	 * getPaymentType
	 *
	 * @return  string
	 */
	public function getPaymentType()
	{
		return $this->data['PaymentType'];
	}

	/**
	 * Method to get property HashKey
	 *
	 * @return  string
	 */
	public function getHashKey()
	{
		return $this->hashKey;
	}

	/**
	 * Method to set property hashKey
	 *
	 * @param   string $hashKey
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setHashKey($hashKey)
	{
		$this->hashKey = $hashKey;

		return $this;
	}

	/**
	 * Method to get property HashIV
	 *
	 * @return  string
	 */
	public function getHashIV()
	{
		return $this->hashIV;
	}

	/**
	 * Method to set property hashIV
	 *
	 * @param   string $hashIV
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setHashIV($hashIV)
	{
		$this->hashIV = $hashIV;

		return $this;
	}
}
