<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Payment;

use Windwalker\Pay2Go\AbstractDataHolder;

/**
 * The AbstractPayment class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractPayment extends AbstractDataHolder
{
	/**
	 * getName
	 *
	 * @return  string
	 */
	abstract public function getName();

	/**
	 * enable
	 *
	 * @return  static
	 */
	public function enable()
	{
		$this->set($this->getName(), 1);

		return $this;
	}

	/**
	 * disable
	 *
	 * @return  static
	 */
	public function disable()
	{
		$this->set($this->getName(), 0);

		return $this;
	}

	/**
	 * isEnabled
	 *
	 * @return  boolean
	 */
	public function isEnabled()
	{
		return (bool) $this->get($this->getName());
	}
}
