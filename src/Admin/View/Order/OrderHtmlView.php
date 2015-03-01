<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Order;

use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Pay2Go\LaterPaymentFeedback;
use Windwalker\Pay2Go\PaidReceiver;

/**
 * The OrderHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderHtmlView extends BladeHtmlView
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
		$data->item = $this->model->getItem();
		$data->form = $this->model->getForm();

		$data->receiver = new PaidReceiver;
		$data->receiver->setData($data->item->params);

		$data->feedback = new LaterPaymentFeedback;
		$data->feedback->setData($data->item->params);
	}
}
