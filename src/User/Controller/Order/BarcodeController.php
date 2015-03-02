<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Order;

use Admin\Helper\OrderHelper;
use Riki\Uri\Uri;
use Windwalker\Core\Controller\Controller;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Pay2Go\AbstractPayment;
use Windwalker\Pay2Go\FeedbackReceiver;
use Windwalker\Table\Table;

/**
 * The BarcodeController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BarcodeController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$order = (new DataMapper(Table::ORDERS))->findOne($this->input->get('id'));

		if ($order->state != OrderHelper::STATE_WAIT_PAY || $order->payment != AbstractPayment::BARCODE)
		{
			throw new \UnexpectedValueException('沒有條碼', 404);
		}

		$pay2go = new FeedbackReceiver;
		$pay2go->setData(json_decode($order->params, true));

		$data = array(
			'logo_img' => Uri::media() . 'img/asukademy-logo-horz.png',
			'site_url' => Uri::root(),
			'copyright' => '2014 - ' . gmdate('Y') . ' Asukademy 飛鳥學院',
			'service_tel' => null,
			'service_email' => 'service@asukademy.com',
		);

		return $pay2go->renderBarcodePage($data);
	}
}
