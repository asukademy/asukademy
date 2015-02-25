<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Model;

use User\Form\LoginFieldDefinition;
use Windwalker\Authenticate\Credential;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Form\Field\AbstractField;
use Windwalker\Form\Form;

/**
 * The LoginModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LoginModel extends DatabaseModel
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
			$form = new Form('user');

			$form->defineFormFields(new LoginFieldDefinition);

			return $form;
		});
	}

	/**
	 * login
	 *
	 * @param string $username
	 * @param string $password
	 *
	 * @return  bool
	 */
	public function login($username, $password)
	{
		$credential = new Credential(array('username' => $username, 'password' => $password));

		if (!User::login($credential, true))
		{
			$this['errors'] = User::getResults();

			return false;
		}

		return true;
	}

	/**
	 * logout
	 *
	 * @param string $username
	 *
	 * @return  bool
	 */
	public function logout($username)
	{
		$credential = new Credential(array('username' => $username));

		if (User::logout($credential))
		{
			return false;
		}

		return true;
	}
}
