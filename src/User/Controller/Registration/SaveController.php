<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Registration;

use Asukademy\Mail\Mailer;
use Asukademy\View\Mail\MailHtmlView;
use User\Helper\UserHelper;
use User\Model\RegistrationModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
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
		if (UserHelper::isLogin())
		{
			$this->setRedirect(Router::buildHttp('user:profile'));

			return true;
		}

		$model   = new RegistrationModel;
		$session = Ioc::getSession();

		$user = $this->input->getVar('registration');
		$user = new Data($user);

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			$this->validate($user);

			$user = $model->register($user);

			$config = Ioc::getConfig();

			if ($config['debug.ignore_mail'])
			{
				$user->state = 1;
				$user->activation = '';

				User::save($user);
			}
			else
			{
				$this->mail($user);
			}
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$session->set('user.registration.data', (array) $user);

			$this->setRedirect($this->package->router->buildHttp('registration'), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$session->set('user.registration.data', (array) $user);

			$this->setRedirect($this->package->router->buildHttp('registration'), '註冊失敗', 'warning');

			return false;
		}

		$trans->commit();

		$session->remove('user.registration.data');

		$this->setRedirect('login', '註冊成功，請前往信箱驗證郵件位址', 'success');

		return true;
	}

	/**
	 * postExecute
	 *
	 * @param Data $user
	 *
	 * @return bool
	 * @throws ValidFailException
	 */
	protected function mail($user = null)
	{
		$emailBody = Mailer::render('mail.activation', ['user' => $user], $this->package);

		$message = Mailer::newMessage()
			->setSubject('歡迎加入飛鳥學院，請由此驗證 Email')
			->setFrom('service@asukademy.com')
			->setFromName('Asukademy 飛鳥學院')
			->setTos(array($user->email))
			->setHtml($emailBody);

		try
		{
			Mailer::send($message);
		}
		catch (\RuntimeException $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			throw new ValidFailException('郵件伺服器出現問題，暫時無法註冊');
		}

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
