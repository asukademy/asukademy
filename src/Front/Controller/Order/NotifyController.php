<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Order;

use Windwalker\Core\Controller\Controller;
use Windwalker\Ioc;
use Windwalker\Pay2Go\Pay2GoReceiver;

/**
 * The NotifyController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class NotifyController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$config = Ioc::getConfig();

		$pay2go = new Pay2GoReceiver($config['pay2go.id'], $config['pay2go.key'], $config['pay2go.iv']);

//		$pay2go->setData($this->input->post->getArray());
		$pay2go->setData($this->getATMData());

		var_dump($pay2go->validate());

		show($pay2go);
	}

	protected function getATMData()
	{
		return array (
			'Status' => 'SUCCESS',
			'Message' => '授權成功',
			'MerchantID' => '3592087',
			'Amt' => '7200',
			'TradeNo' => '15022713311757163',
			'MerchantOrderNo' => '771_54f00115118b6',
			'RespondType' => 'String',
			'CheckCode' => 'AE68DC706B5CCC7310069AC9DD575ADEC63451FD72333F3EE78203ED9C7313FD',
			'IP' => '219.68.97.4',
			'EscrowBank' => 'Cosmos',
			'PaymentType' => 'CREDIT',
			'RespondCode' => '00',
			'Auth' => '930637',
			'Card6No' => '400022',
			'Card4No' => '2222',
			'InstFirst' => '7200',
			'InstEach' => '0',
			'Inst' => '0',
			'ECI' => '',
			'PayTime' => '2015-02-27 13:31:17',
		);
	}
}
