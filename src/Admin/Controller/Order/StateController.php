<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Order;

use Admin\Helper\OrderHelper;
use Admin\Model\CourseModel;
use Admin\Model\OrderModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The SaveController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class StateController extends Controller
{
	/**
	 * Property model.
	 *
	 * @var  OrderModel
	 */
	protected $model;

	/**
	 * doExecute
	 *
	 * @return  mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$id = $this->input->get('id');
		$this->model = $model = new OrderModel;

		if (!$id)
		{
			throw new \Exception('No id');
		}

		$state = $this->input->getByPath('state.' . $id);

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			$data = new Data;

			$previous = (new DataMapper(Table::ORDERS))->findOne($id);

			$this->preSave($data, $state, $previous->state);

			// Prepare default data
			// -----------------------------------------
			$data['id'] = $id;
			$data['state'] = $state;
			// -----------------------------------------

			$model->update($data);

			$this->model['item.id'] = $previous->plan_id;

			$this->postSave($data, $state, $previous->state);
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$this->setRedirect(Router::buildHttp('admin:orders'), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:orders'), 'Save fail', 'danger');

			return false;
		}

		$trans->commit();

		$this->setRedirect(Router::buildHttp('admin:orders'), 'Save Success', 'success');

		return true;
	}

	/**
	 * preSave
	 *
	 * @param Data $data
	 * @param int  $state
	 * @param int  $previousState
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	public function preSave($data, $state, $previousState)
	{
		// 將開始付款的狀態改成取消
		if ($previousState >= OrderHelper::STATE_WAIT_PAY && $state <= OrderHelper::STATE_CANCELED)
		{
			$data->payment = '';
			$data->params = '';
		}

		if ($state == OrderHelper::STATE_PENDING)
		{
			throw new ValidFailException('您無法把狀態改成審核中');
		}

		if ($previousState == OrderHelper::STATE_CANCELED)
		{
			throw new ValidFailException('已經取消的訂單無法還原');
		}

		if ($state == OrderHelper::STATE_WAIT_PAY && $previousState >= OrderHelper::STATE_PAID_SUCCESS)
		{
			throw new ValidFailException('已繳費成功的只能取消，不能改回繳費中');
		}

		if ($state >= OrderHelper::STATE_PROCESSING)
		{
			throw new ValidFailException('進行中與報名成功為自動狀態，不能更改');
		}
	}

	/**
	 * postSave
	 *
	 * @return  void
	 */
	public function postSave($data, $state, $previousState)
	{
		if ($state == OrderHelper::STATE_CANCELED)
		{
			$model = $this->model;

			$model->reduceQuantity();
		}
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @throws  ValidFailException
	 * @return  boolean
	 */
	protected function validate($data)
	{
		return true;
	}
}
