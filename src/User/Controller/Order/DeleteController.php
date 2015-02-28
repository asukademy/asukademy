<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Order;

use Front\Model\OrderModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Ioc;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Database\DatabaseFactory;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The DeleteController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DeleteController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$id = $this->input->get('id');

		$user = User::get();

		$model = new OrderModel;

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			if (!$id)
			{
				throw new ValidFailException('No id');
			}

			$order = new Record(Table::ORDERS);

			$order->load($id);

			if ($order->user_id != $user->id)
			{
				throw new ValidFailException('請不要刪除別人的訂單');
			}

			$order->state = -1;
			$order->params = '';

			$order->check()
				->store(Record::UPDATE_NULLS);

			$model['item.id'] = $order->plan_id;

			$model->reduceQuantity();
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$this->setRedirect(Router::buildHttp('user:courses'), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('user:courses'), '操作失敗', 'warning');

			return false;
		}

		$trans->commit();

		$this->setRedirect(Router::buildHttp('user:courses'), '課程已取消', 'success');

		return true;
	}
}
