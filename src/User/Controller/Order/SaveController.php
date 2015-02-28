<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Order;

use Front\Model\OrderModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\Ioc;
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

		if ($config['pay2go.test'])
		{
			$orderNo = explode('_', $orderNo);

			$orderNo = $orderNo[0];
		}

		if (!$pay2go->validate())
		{
			$this->setRedirect(Router::buildHttp('user:order', ['id' => $orderNo]), '訂單驗證失敗', 'warning');
		}

		$pay2go->setMerchantOrderNo($orderNo);

		$type = $pay2go->getPaymentType();
		$orderNo = $pay2go->getMerchantOrderNo();

		$data['id']      = $orderNo;
		$data['payment'] = $type;
		$data['params']  = json_encode($pay2go->getData());

		// Is Later payment?
		if ($pay2go->payment->isInstantPayment())
		{
			$data['state'] = 2;
		}

		$model = new OrderModel;

		$order = $model->getItem($orderNo);

		if ($order->state >= 2)
		{
			$this->setRedirect(Router::buildHttp('user:order', ['id' => $orderNo]), '已付款完成', 'success');

			return true;
		}

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

		$this->setRedirect(Router::buildHttp('user:order', ['id' => $orderNo]), '已付款完成', 'success');

		return true;
	}
}
