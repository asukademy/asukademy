<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Model;

use User\Form\ProfileFieldDefinition;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\Form\Form;
use Windwalker\Ioc;

/**
 * The ProfileModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfileModel extends DatabaseModel
{
	/**
	 * getItem
	 *
	 * @return  \Windwalker\Core\Authenticate\UserData
	 */
	public function getItem()
	{
		return User::get();
	}

	/**
	 * getForm
	 *
	 * @param bool $loadData
	 *
	 * @return Form
	 */
	public function getForm($loadData = true)
	{
		return $this->fetch('profile', function() use ($loadData)
		{
			$form = new Form('user');

			$form->defineFormFields(new ProfileFieldDefinition);

			if (!$loadData)
			{
				return $form;
			}

			$session = Ioc::getSession();

			$user = $session->get('profile.edit.data');

			if ($user)
			{
				$session->remove('profile.edit.data');
			}
			else
			{
				$user = $this->getItem();
			}

			unset($user['password']);
			unset($user['password2']);

			$form->bind($user);

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
	public function save($user)
	{
		if ($user->password)
		{
			if ($user->password != $user->password2)
			{
				throw new ValidFailException('密碼不一致');
			}

			$password = new Password;

			$user->password = $password->create($user->password);

			unset($user->password2);
		}

		User::save($user);

		return true;
	}
}
