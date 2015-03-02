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
use Windwalker\Pay2Go\AbstractPayment;
use Windwalker\Pay2Go\PaidReceiver;
use Windwalker\Pay2Go\Pay2GoHelper;

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
		$log->pushHandler(new StreamHandler(WINDWALKER_LOGS . '/pay2go-notify.log', Logger::INFO));

//		$post = $this->getCreditData();
//		$post = $this->input->post->getArray();
		$post = $this->input->getArray();

		$log->addInfo('Receive Notify: ' . print_r($post, 1));

		$pay2go->setData($post);

		if (!$pay2go->validate())
		{
			return '驗證失敗';
		}

		if ($pay2go->getStatus() != AbstractPayment::STATUS_SUCCESS)
		{
			return Pay2GoHelper::getErrorTitle($pay2go->getStatus());
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
}
