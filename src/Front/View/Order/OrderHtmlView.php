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
use Windwalker\Ioc;
use Windwalker\Table\Table;
use Windwalker\Database\Schema\Column;

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

		$data->plan = $this->model->getPlan();
		$data->form = $this->model->getForm();
		$data->user = User::get();
	}
}
