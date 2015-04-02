<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Order;

use Admin\Helper\OrderHelper;
use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Pay2Go\FeedbackReceiver;
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

		if ($data->item->params)
		{
			$data->item->params = json_decode($data->item->params);
		}

		$data->receiver = new PaidReceiver;
		$data->receiver->setData($data->item->params);

		$data->feedback = new FeedbackReceiver;
		$data->feedback->setData($data->item->params);

		// State
		OrderHelper::setExtraState($data->item);
	}
}
