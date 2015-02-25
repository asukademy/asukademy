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
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$data = new Data($this->data);

		try
		{
			$this->validate();
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('user:login'), $e->getMessage(), 'warning');
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('user:login'), '因系統問題造成的登入失敗，請聯絡網站管理員', 'warning');
		}

		$this->setRedirect('/', '登入成功', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	private function validate()
	{
		$form = $this->model->getForm(false);

		$form->bind($this->data);

		if (!$form->validate())
		{
			$msgs = [];

			foreach ($form->getErrors() as $error)
			{
				$msgs[] = $error->getMessage();
			}

			throw new ValidFailException(implode($msgs, '<br>'));
		}

		$user = new Data($this->data);

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

		if ($user->passwordstrlen($user->password) < 4)
		{
			throw new ValidFailException('請至少輸入 4 位數密碼');
		}
	}
}
