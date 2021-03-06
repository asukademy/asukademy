<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Order;

use Front\Model\OrderModel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Pay2Go\AbstractPayment;
use Windwalker\Pay2Go\PaidReceiver;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$config = Ioc::getConfig();

		$pay2go = new PaidReceiver($config['pay2go.id'], $config['pay2go.key'], $config['pay2go.iv']);

		$pay2go->setData($this->input->post->getArray());

		$orderNo = $pay2go->getMerchantOrderNo();

		// Logger
		$log = new Logger('name');
		$log->pushHandler(new StreamHandler(WINDWALKER_LOGS . '/pay2go-return.log', Logger::INFO));
		$log->addInfo('Get Return Value: ' . print_r($this->input->post->getArray(), 1));

		// if ($config['pay2go.test'])
		{
			$orderNo = explode('_', $orderNo);

			$orderNo = $orderNo[0];
		}

		if ($pay2go->getStatus() != AbstractPayment::STATUS_SUCCESS)
		{
			$this->setRedirect(Router::buildHttp('user:order', ['id' => $this->input->get('id')]), $pay2go->getMessage(), 'warning');

			return false;
		}

		if (!$pay2go->validate())
		{
			$this->setRedirect(Router::buildHttp('user:order', ['id' => $this->input->get('id')]), '訂單驗證失敗', 'warning');

			return false;
		}

		$pay2go->setMerchantOrderNo($orderNo);

		$type = $pay2go->getPaymentType();
		$orderNo = $pay2go->getMerchantOrderNo();

		$data['id'] = $orderNo;
		$data['expire_time'] = $pay2go->getExpireDate();
		$data['payment'] = $type;

		// Is instant payment?
		if ($pay2go->payment->isInstantPayment())
		{
			$data['state'] = 2;
		}

		$data['params'] = json_encode($pay2go->getData());

		$model = new OrderModel;

		// $order = $model->getItem($orderNo);

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

			$this->setRedirect(Router::buildHttp('user:order', ['id' => $orderNo]), '訂單狀態更改失敗', 'warning');

			return false;
		}

		$this->setRedirect(Router::buildHttp('user:order', ['id' => $orderNo]), '收到付款資料', 'success');

		return true;
	}
}
