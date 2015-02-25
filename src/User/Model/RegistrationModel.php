<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Model;

use User\Form\RegistrationFieldDefinition;
use User\Helper\UserHelper;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\Form\Form;
use Windwalker\Ioc;

/**
 * The RegistrationModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RegistrationModel extends DatabaseModel
{
	/**
	 * getForm
	 *
	 * @return  Form
	 */
	public function getForm()
	{
		return $this->fetch('login.form', function()
		{
			$form = new Form('registration');

			$form->defineFormFields(new RegistrationFieldDefinition);

			$session = Ioc::getSession();

			$user = $session->get('user.registration.data');

			if ($user)
			{
				unset($user['password']);
				unset($user['password2']);

				$form->bind($user);

				$session->remove('user.registration.data');
			}

			return $form;
		});
	}

	/**
	 * register
	 *
	 * @param Data $user
	 *
	 * @throws \Exception
	 * @return  bool
	 */
	public function register($user)
	{
		if ($user->password != $user->password2)
		{
			throw new ValidFailException('密碼不一致');
		}

		$password = new Password;

		$user->password = $password->create($user->password);

		unset($user->password2);

		$user->activation = UserHelper::createActivationCode($user->username);

		User::save($user);

		return true;
	}
}
