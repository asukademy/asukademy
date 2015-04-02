<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Order;

use Riki\Controller\AbstractSaveController;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Data\Data;
use Windwalker\Record\Record;
use Windwalker\String\String;
use Windwalker\Table\Table;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractSaveController
{
	/**
	 * Property isNew.
	 *
	 * @var  boolean
	 */
	public $isNew = false;

	/**
	 * preSave
	 *
	 * @param Data $data
	 *
	 * @return void
	 */
	protected function preSave(Data $data)
	{
		$this->isNew = !(bool) $data->id;

		if ($this->isNew)
		{
			$user = User::get(['username' => $data->username]);

			if ($user->isNull())
			{
				throw new ValidFailException('User not found');
			}

			$data->user_id = $user->id;

			unset($user->state);
			unset($user->id);

			foreach ($data as $k => $v)
			{
				if (String::isEmpty($v))
				{
					$data->$k = $user->$k;
				}
			}

			$plan = $this->model->getPlan($data->plan_id);

			$data->stage_id = $plan->stage->id;
			$data->course_id = $plan->course->id;
		}
	}

	/**
	 * doSave
	 *
	 * @param Data $data
	 *
	 * @return bool
	 */
	protected function doSave(Data $data)
	{
		if ($this->isNew)
		{
			$this->model['item.id'] = $data->plan_id;

			$this->model->create($data);
		}
		else
		{
			$this->model->update($data);
		}

		$data->id = $this->model['item.id'];

		return true;
	}

	/**
	 * postSave
	 *
	 * @param Data $data
	 *
	 * @return bool
	 * @throws ValidFailException
	 */
	protected function postSave(Data $data)
	{
		if (!$this->hmvc($ctrl = new StateController, ['id' => $data->id, 'state' => [$data->id => $data->state]]))
		{
			$rdr = $ctrl->getRedirect();

			throw new ValidFailException($rdr['msg']);
		}

		return true;
	}

	protected function validate(Data $data)
	{
		if ($this->isNew)
		{
			if (!$data->username)
			{
				throw new ValidFailException('Please enter Username');
			}

			if (!$data->plan_id)
			{
				throw new ValidFailException('Please choose a Plan');
			}
		}

		if (!$data->name)
		{
			throw new ValidFailException('需要名字');
		}

		if (!$data->email)
		{
			throw new ValidFailException('需要 Email');
		}
	}
}
