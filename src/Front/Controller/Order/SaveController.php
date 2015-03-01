<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Order;

use Admin\Helper\TransactionHelper;
use DateTime;
use Front\Model\OrderModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Authenticate\UserData;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\Ioc;
use Windwalker\Validator\Rule\EmailValidator;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * Property data.
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Property model.
	 *
	 * @var OrderModel
	 */
	protected $model;

	/**
	 * Property user.
	 *
	 * @var  UserData
	 */
	protected $user;

	/**
	 * Property plan_id.
	 *
	 * @var int
	 */
	protected $plan_id;

	/**
	 * Property plan.
	 *
	 * @var  Data
	 */
	protected $plan;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		$this->data  = $this->input->getVar('user');
		$this->model = new OrderModel;
		$this->user  = User::get();
		$this->plan_id = $this->input->get('plan_id');

		$this->model['item.id'] = $this->plan_id;

		$this->plan  = $this->model->getPlan();
	}

	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$data = new Data($this->data);

		$session = Ioc::getSession();

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			$this->validate($data);

			// Fill data
			$data->user_id    = $this->user->id;
			$data->plan_id    = $this->plan->id;
			$data->plan_title = $this->plan->title;
			$data->course_id  = $this->plan->course->id;
			$data->stage_id   = $this->plan->stage->id;
			$data->price      = $this->plan->price;
			$data->created    = (new DateTime('now'))->format('Y-m-d H:i:s');
			$data->state      = $this->plan->require_validate ? 0 : 1;

			$this->model->create($data);

			if ($this->input->get('save_to_profile'))
			{
				$user = User::get();

				$user->bind($this->data);

				User::save($user);

				$session = Ioc::getSession();

				$session->set('user', User::get($user->id));
			}
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$session->set('order.create.data', $data);

			$this->setRedirect(Router::buildHttp('front:order', ['plan_id' => $this->plan_id]), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$session->set('order.create.data', $data);

			$this->setRedirect(Router::buildHttp('front:order', ['plan_id' => $this->plan_id]), '報名失敗', 'warning');

			return false;
		}

		$trans->commit();

		$session->remove('order.create.data');

		$this->setRedirect(Router::buildHttp('user:order', ['id' => $this->model['item.id']]), '報名成功', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	private function validate($data)
	{
		$user = $data;

		if (!$user->name)
		{
			throw new ValidFailException('請輸入姓名');
		}

		if (!$user->email)
		{
			throw new ValidFailException('請輸入 Email 讓我們可以聯絡您');
		}

		$emailValidator = new EmailValidator;

		if (!$emailValidator->validate($user->email))
		{
			throw new ValidFailException('Email 格式不正確');
		}
	}
}
