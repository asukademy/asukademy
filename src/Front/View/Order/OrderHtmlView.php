<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Order;

use Front\View\AbstractFrontHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Database\Schema\Column;
use Windwalker\Ioc;

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
	 * @throws \Exception
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$data->plan = $this->model->getPlan();
		$data->form = $this->model->getForm();
		$data->user = User::get();

		$start = new \DateTime($data->plan->stage->start);
		$now = new \DateTime;

		if ($now > $start)
		{
			throw new \Exception('課程已開始', 404);
		}
	}
}
