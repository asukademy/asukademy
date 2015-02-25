<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Registration;

use User\Model\RegistrationModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Widget\BladeWidget;
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
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function doExecute()
	{
		$model   = new RegistrationModel;
		$session = Ioc::getSession();

		$user = $this->input->getVar('registration');
		$user = new Data($user);

		try
		{
			$this->validate($user);

			$model->register($user);
		}
		catch (ValidFailException $e)
		{
			$session->set('user.registration.data', (array) $user);

			$this->setRedirect($this->package->router->buildHttp('registration'), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			$session->set('user.registration.data', (array) $user);

			$this->setRedirect($this->package->router->buildHttp('registration'), '註冊失敗', 'warning');

			return false;
		}

		$session->remove('user.registration.data');

		$this->setRedirect('login', '註冊成功，請前往信箱驗證郵件位址', 'success');

		$this->mail($user);

		return true;
	}

	/**
	 * postExecute
	 *
	 * @param Data $user
	 *
	 * @return bool
	 *
	 */
	protected function mail($user = null)
	{
		$emailBody = (new BladeWidget('mail.activation', 'user'))->render(['user' => $user]);



		return true;
	}

	/**
	 * validate
	 *
	 * @param Data $user
	 *
	 * @throws ValidFailException
	 */
	private function validate($user)
	{
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

		if (!$user->password)
		{
			throw new ValidFailException('請輸入密碼');
		}

		if (strlen($user->password) < 4)
		{
			throw new ValidFailException('請至少輸入 4 位數密碼');
		}
	}
}
