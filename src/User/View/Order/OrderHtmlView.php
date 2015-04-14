<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\View\Order;

use Admin\Helper\OrderHelper;
use Front\View\AbstractFrontHtmlView;
use Riki\Uri\Uri;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Router\RestfulRouter;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Pay2Go\FeedbackReceiver;
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
		$data->feedback = new FeedbackReceiver;
		$data->payment = new PaidReceiver;

		$data->payment->setData($data->item->params->toArray());

		// if ($data->feedback->isSupport($data->item->payment))
		{
			$data->feedback->setData($data->item->params->toArray());
		}

		$data->paymentType = $data->payment->getPaymentType();

		$this->preparePayment($data);

		OrderHelper::setExtraState($data->item);
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

		// if ($config['pay2go.test'])
		{
			$orderNo .= '_' . strtoupper(substr(md5(uniqid(rand(0, 9))), 0, 4));
		}

		$notifyUrl = $config['pay2go.notify'] ? : Router::buildHttp('front:order_notify', [], RestfulRouter::TYPE_FULL);

		$pay2go->setTest($config['pay2go.test'])
			->setMerchantOrderNo($orderNo)
			->setVersion('1.1')
			->setAmt((int) $item->price)
			->setRespondType(Pay2Go::RESPONSE_TYPE_STRING)
			->setItemDesc($item->course->title . ' - ' . $item->stage->title . ' (' . $item->plan->title . ')')
			->setEmail($item->email)
			->setLoginType(0)
			->setNotifyURL($notifyUrl)
			->setReturnURL(Router::buildHttp('user:order', ['id' => $item->id], RestfulRouter::TYPE_FULL))
			->setCustomerURL(Router::buildHttp('user:order', ['id' => $item->id], RestfulRouter::TYPE_FULL));

		$pay2go->atm->enable();
		$pay2go->barcode->enable();
		$pay2go->cvs->enable();
		$pay2go->webATM->enable();

		$pay2go->creditCard->enable()
			//->setUNIONPAY(1)
			->installment('3, 6, 12');
		/*
		$pay2go->alipay->enable()
			->setReceiver('ASukademy')
			->setTel1('123-12312-123')
			->setTel2('123-123-123')
			->setCount(1)
			->addProduct(
				$item->id,
				$item->course->title,
				$item->stage->title . ' (' . $item->plan->title . ')',
				(int) $item->price,
				1
			);

		$pay2go->tenpay->enable()
			->setReceiver('ASukademy')
			->setTel1('123-12312-123')
			->setTel2('123-123-123')
			->setCount(1)
			->addProduct(
				$item->id,
				$item->course->title,
				$item->stage->title . ' (' . $item->plan->title . ')',
				(int) $item->price,
				1
			);
		*/
		$data->pay2go = $pay2go;
	}
}
