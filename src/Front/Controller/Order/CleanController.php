<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Order;

use Admin\Controller\Order\StateController;
use Admin\Helper\OrderHelper;
use Admin\Model\OrderModel;
use Asukademy\Helper\DateTimeHelper;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\DataMapper\DataMapper;
use Windwalker\IO\Input;
use Windwalker\Ioc;
use Windwalker\String\String;
use Windwalker\Table\Table;
use Windwalker\Web\Application;

/**
 * The CleanController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CleanController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$token = $this->input->get($this->app->get('system.secret'));

		if ($token === null)
		{
			exit('Forbidden');
		}

		$mapper = new DataMapper(Table::ORDERS);

		$now = DateTimeHelper::format('now');

		$orders = $mapper->find(['expire_time <= ' . String::quote($now, '"'), 'expire_time != "0000-00-00 00:00:00"']);

		$model = new OrderModel;

		foreach ($orders as $order)
		{
			$model['item.id'] = $order->id;

			$input = ['id' => $order->id, 'state' => [$order->id => OrderHelper::STATE_CANCELED]];

			$ctrl = new StateController(new Input($input), $this->app, $this->container, PackageHelper::getPackage('admin'));

			// Logger
			$log = new Logger('clean-expired');

			if (!$ctrl->execute())
			{
				$rdr = $ctrl->getRedirect();

				$log->pushHandler(new StreamHandler(WINDWALKER_LOGS . '/clean-expired-error.log', Logger::ERROR));
				$log->addInfo('Error Message: ' . $rdr['msg']);
			}
			else
			{
				$log->pushHandler(new StreamHandler(WINDWALKER_LOGS . '/clean-expired-success.log', Logger::INFO));
				$log->addInfo('Order ' . $order->id . ' canceled.');
			}
		}

		return true;
	}
}
