<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go;

/**
 * The Pay2Go class.
 *
 * @method  string  getMerchantID()  getMerchantID()
 * @method  Pay2Go  setMerchantID()  setMerchantID($value)
 * @method  string  getRespondType()  getRespondType()
 * @method  Pay2Go  setRespondType()  setRespondType($value)
 * @method  string  getMerchantOrderNo()  getMerchantOrderNo()
 * @method  Pay2Go  setMerchantOrderNo()  setMerchantOrderNo($value)
 * @method  string  getTimeStamp()  getTimeStamp()
 * @method  Pay2Go  setTimeStamp()  setTimeStamp($value)
 * @method  string  getVersion()  getVersion()
 * @method  Pay2Go  setVersion()  setVersion($value)
 * @method  string  getAmt()  getAmt()
 * @method  Pay2Go  setAmt()  setAmt($value)
 * @method  string  getItemDesc()  getItemDesc()
 * @method  Pay2Go  setItemDesc()  setItemDesc($value)
 * @method  string  getExpireDate()  getExpireDate()
 * @method  Pay2Go  setExpireDate()  setExpireDate($value)
 * @method  Pay2Go  setReturnURL()  setReturnURL($value)
 * @method  string  getReturnURL()  getReturnURL()
 * @method  string  getNotifyURL()  getNotifyURL()
 * @method  Pay2Go  setNotifyURL()  setNotifyURL($value)
 * @method  Pay2Go  setCustomerURL()  setCustomerURL($value)
 * @method  string  getCustomerURL()  getCustomerURL()
 * @method  string  getEmail()  getEmail()
 * @method  Pay2Go  setEmail()  setEmail($value)
 * @method  string  getLoginType()  getLoginType()
 * @method  Pay2Go  setLoginType()  setLoginType($value)
 *
 * @since  {DEPLOY_VERSION}
 */
class Pay2Go
{
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
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'MerchantID'  => null,
		'RespondType' => 'JSON',
		'CheckValue'  => null,
		'TimeStamp'   => null,
		'MerchantOrderNo' => null,
		'Version'    => '1.1',
		'Amt'        => null,
		'ItemDesc'   => null,
		'ExpireDate' => null,
		'ReturnURL'  => null,
		'NotifyURL'  => null,
		'CustomerURL' => null,
		'Email'     => null,
		'LoginType' => 1
	);

	/**
	 * Property test.
	 *
	 * @var  boolean
	 */
	protected $test = false;

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
	 * setData
	 *
	 * @param array|object $data
	 *
	 * @return  static
	 */
	public function setData($data)
	{
		if ($data instanceof \Traversable)
		{
			$data = iterator_to_array($data);
		}

		if (is_object($data))
		{
			$data = get_object_vars($data);
		}

		$this->data = array_merge($this->data, (array) $data);

		return $this;
	}

	/**
	 * get
	 *
	 * @param string $name
	 * @param mixed  $value
	 *
	 * @return  static
	 */
	public function set($name, $value = null)
	{
		$this->data[$name] = $value;

		return $this;
	}

	/**
	 * get
	 *
	 * @param string $name
	 * @param mixed  $default
	 *
	 * @return  mixed
	 */
	public function get($name, $default = null)
	{
		if (isset($this->data[$name]))
		{
			return $this->data[$name];
		}

		return $default;
	}

	/**
	 * __call
	 *
	 * @param string $name
	 * @param array  $args
	 *
	 * @return  mixed
	 */
	public function __call($name, $args = array())
	{
		if (substr($name, 0, 3) == 'get')
		{
			$name = substr($name, 3);

			return $this->get($name);
		}

		if (substr($name, 0, 3) == 'set')
		{
			$name = substr($name, 3);

			array_unshift($args, $name);

			return call_user_func_array(array($this, 'set'), $args);
		}

		throw new \BadMethodCallException(get_called_class() . '::' . $name . '() not exists.');
	}

	/**
	 * render
	 *
	 * @param string $formId
	 *
	 * @return  string
	 */
	public function render($formId = 'pay2go-form')
	{
		return sprintf(
			'<form action="%s" id="%s" method="post">%s</form>',
			$this->getPostUrl(),
			$formId,
			$this->renderInputs()
		);
	}

	/**
	 * renderInputs
	 *
	 * @return  string
	 */
	public function renderInputs()
	{
		$this->prepareRender();

		$inputs = array();

		foreach ($this->data as $key => $value)
		{
			$inputs[] = sprintf('<input type="hidden" name="%s" value="%s">', $key, $value);
		}

		return implode("\n", $inputs);
	}

	/**
	 * prepareRender
	 *
	 * @return  static
	 */
	public function prepareRender()
	{
		if (!$this->getTimeStamp())
		{
			$this->setTimeStamp(time());
		}

		$this->set('CheckValue', $this->getCheckValue());

		return $this;
	}

	/**
	 * getCheckValue
	 *
	 * @return  string
	 */
	public function getCheckValue()
	{
		$merArray = array(
			'MerchantID'     => $this->getMerchantID(),
			'TimeStamp'      => $this->getTimeStamp(),
			'MerchantOrderNo'=> $this->getMerchantOrderNo(),
			'Version'        => $this->getVersion(),
			'Amt'            => $this->getAmt(),
		);

		$key = $this->getHashKey();
		$iv  = $this->getHashIV();

		ksort($merArray);
		$checkMerstr = http_build_query($merArray);
		$CheckValueSTR = "HashKey=$key&$checkMerstr&HashIV=$iv";

		return strtoupper(hash("sha256", $CheckValueSTR));
	}

	/**
	 * getPostUrl
	 *
	 * @return  string
	 */
	public function getPostUrl()
	{
		if ($this->test)
		{
			return 'https://capi.pay2go.com/MPG/mpg_gateway';
		}

		return 'https://api.pay2go.com/MPG/mpg_gateway';
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
	 * Method to get property Test
	 *
	 * @return  boolean
	 */
	public function getTest()
	{
		return $this->test;
	}

	/**
	 * Method to set property test
	 *
	 * @param   boolean $test
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setTest($test)
	{
		$this->test = $test;

		return $this;
	}
}
