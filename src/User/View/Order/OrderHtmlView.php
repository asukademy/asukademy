<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\View\Order;

use Front\View\AbstractFrontHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Pay2Go\LaterPaymentFeedback;
use Windwalker\Pay2Go\PaidReceiver;
use Windwalker\Pay2Go\Pay2Go;
use Windwalker\Registry\Registry;

/**
 * The OrderHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderHtmlView extends AbstractFrontHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$data->item = $this->model->getItem();
		$data->user = User::get();
		$data->item->params = new Registry($data->item->params);
		$data->feedback = new LaterPaymentFeedback;
		$data->payment = new PaidReceiver;

		$data->payment->setData($data->item->params->toArray());
		$data->feedback->setData($data->item->params->toArray());
		$data->paymentType = $data->payment->getPaymentType();

		$this->preparePayment($data);
	}

	/**
	 * preparePayment
	 *
	 * @param Data $data
	 *
	 * @return  void
	 */
	protected function preparePayment($data)
	{
		$config = Ioc::getConfig();

		$pay2go = new Pay2Go($config['pay2go.id'], $config['pay2go.key'], $config['pay2go.iv']);

		$item = $data->item;

		$orderNo = $item->id;

		if ($config['pay2go.test'])
		{
			$orderNo .= '_' . uniqid();
		}

		$pay2go->setTest($config['pay2go.test'])
			->setMerchantOrderNo($orderNo)
			->setVersion('1.1')
			->setAmt((int) $item->price)
			->setRespondType(Pay2Go::RESPONSE_TYPE_STRING)
			->setItemDesc($item->course->title . ' - ' . $item->stage->title . ' (' . $item->plan->title . ')')
			->setEmail($item->email)
			->setLoginType(0)
			->setNotifyURL('http://dev.asika.tw/pay2go/notify.php')
			// ->setReturnURL('http://asukademy.test:8000//user/order/' . $item->id)
			->setCustomerURL('http://asukademy.test:8000//user/order/' . $item->id)
		;

		$pay2go->creditCard
			->enable()
			->setUNIONPAY(1)
			->installment(0);

		$pay2go->atm->enable();
		$pay2go->barcode->enable();
		$pay2go->cvs->enable();
		$pay2go->webATM->enable();

		$data->pay2go = $pay2go;
	}
}
