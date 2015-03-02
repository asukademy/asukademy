<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Order;

use Front\Model\OrderModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Pay2Go\PaidReceiver;

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
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$config = Ioc::getConfig();

		$pay2go = new PaidReceiver($config['pay2go.id'], $config['pay2go.key'], $config['pay2go.iv']);

		// create a log channel
		$log = new Logger('name');
		$log->pushHandler(new StreamHandler(WINDWALKER_LOGS . '/pay2go.log', Logger::INFO));

//		$post = $this->getCreditData();
//		$post = $this->input->post->getArray();
		$post = $this->input->getArray();

		$log->addInfo('Receive Notify: ' . print_r($post, 1));

		$pay2go->setData($post);

		if (!$pay2go->validate())
		{
			return '驗證失敗';
		}

		if ($config['pay2go.test'])
		{
			$orderNo = $pay2go->getMerchantOrderNo();
			$orderNo = explode('_', $orderNo);

			$pay2go->setMerchantOrderNo($orderNo[0]);
		}

		$type = $pay2go->getPaymentType();
		$orderNo = $pay2go->getMerchantOrderNo();

		$data['id']        = $orderNo;
		$data['payment']   = $type;
		$data['paid_time'] = $pay2go->getPayTime();
		$data['expire_time'] = '';
		$data['params']    = json_encode($pay2go->getData());
		$data['state']     = 2;

		$model = new OrderModel;

		$order = $model->getItem($orderNo);

		try
		{
			$model->update(new Data($data));
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			echo '訂單更改失敗';

			return false;
		}

		$log->addInfo('Change Stage: ' . print_r($data, 1));

		return true;
	}

	protected function getCreditData()
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

	protected function getATMData()
	{
		return array (
			'Status' => 'SUCCESS',
			'Message' => '取號成功',
			'MerchantName' => 'Asukademy',
			'MerchantID' => '3592087',
			'Amt' => '7200',
			'TradeNo' => '15022713312764395',
			'MerchantOrderNo' => '771_54f00126643b5',
			'ReturnURL' => '',
			'CheckCode' => 'FDED801CBFBD2CA3A0D1278FB166BD68D0591D5C49ACB646DB9A08974A9F0588',
			'PaymentType' => 'VACC',
			'IP' => '',
			'EscrowBank' => '',
			'ExpireDate' => '2015-03-06',
			'BankCode' => '017',
			'CodeNo' => 'TestAccount123456',
		);
	}
}
