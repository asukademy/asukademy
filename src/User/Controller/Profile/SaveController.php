<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Profile;

use User\Model\ProfileModel;
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
	 * @var ProfileModel
	 */
	protected $model;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		$this->data = $this->input->getVar('user');
		$this->model = new ProfileModel;
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

		try
		{
			$this->validate($data);

			$this->model->save($data);
		}
		catch (ValidFailException $e)
		{
			$session->set('profile.edit.data', $data);

			$this->setRedirect(Router::buildHttp('user:profile'), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$session->set('profile.edit.data', $data);

			$this->setRedirect(Router::buildHttp('user:profile'), '儲存失敗', 'warning');

			return false;
		}

		$session->remove('profile.edit.data');

		// Reset user
		$session->set('user', $data);

		$this->setRedirect(Router::buildHttp('user:profile'), '儲存成功', 'success');

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
		$form = $this->model->getForm(false);

		$form->bind($data);

		if (!$form->validate())
		{
			$msgs = [];

			foreach ($form->getErrors() as $error)
			{
				$msgs[] = $error->getMessage();
			}

			throw new ValidFailException(implode($msgs, '<br>'));
		}

		$user = $data;

		if (!$user->username)
		{
			throw new ValidFailException('請輸入帳號');
		}

		if (!$user->name)
		{
			throw new ValidFailException('請輸入姓名');
		}

		if (!$user->email)
		{
			throw new ValidFailException('請輸入 Email');
		}

		$emailValidator = new EmailValidator;

		if (!$emailValidator->validate($user->email))
		{
			throw new ValidFailException('Email 格式不正確');
		}

		if ($user->password && strlen($user->password) < 4)
		{
			throw new ValidFailException('請至少輸入 4 位數密碼');
		}
	}
}
