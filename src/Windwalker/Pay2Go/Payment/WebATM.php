<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Pay2Go\Payment;

/**
 * The WebATM payment.
 *
 * @since  {DEPLOY_VERSION}
 */
class WebATM extends AbstractPayment
{
	/**
	 * Property data.
	 *
	 * @var  array
	 */
	protected $data = array(
		'WEBATM' => null
	);

	/**
	 * getName
	 *
	 * @return  string
	 */
	public function getName()
	{
		return 'WEBATM';
	}
}
