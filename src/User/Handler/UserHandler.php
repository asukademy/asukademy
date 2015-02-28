<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Handler;

use Admin\Record\UserRecord;
use Windwalker\Core\Authenticate\User;
use User\Data\UserData;
use Windwalker\Core\Authenticate\UserDataInterface;
use Windwalker\Core\Authenticate\UserHandlerInterface;
use Windwalker\Core\Ioc;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Record\Record;

/**
 * The UserHandler class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserHandler implements UserHandlerInterface
{
	/**
	 * Property mapper.
	 *
	 * @var DataMapper
	 */
	protected $mapper;

	/**
	 * load
	 *
	 * @param array $conditions
	 *
	 * @return  UserDataInterface
	 */
	public function load($conditions)
	{
		if (is_object($conditions))
		{
			$conditions = get_object_vars($conditions);
		}

		if (!$conditions)
		{
			$session = Ioc::getSession();

			$user = $session->get('user');
		}
		else
		{
			$user = $this->getDataMapper()->findOne($conditions);
		}

		$user = new UserData((array) $user);

		return $user;
	}

	/**
	 * create
	 *
	 * @param UserDataInterface|UserData $user
	 *
	 * @return  UserData
	 */
	public function save(UserDataInterface $user)
	{
		$currentUser = User::get();

		if (!$currentUser->isAdmin())
		{
			unset($user->group);
			unset($user->username);
			unset($user->state);
		}

		if ($currentUser->isMember() && $currentUser->id != $user->id)
		{
			throw new \InvalidArgumentException('Not self.');
		}

		if ($user->id)
		{
			$data = $this->getDataMapper()->findOne($user->id);
		}
		else
		{
			$data = new Data;
		}

		$data->bind($user);

		$data = $this->getDataMapper()->saveOne($data, 'id', true);

		$user->id = $data->id;

		return $user;
	}

	/**
	 * delete
	 *
	 * @param UserDataInterface|UserData $user
	 *
	 * @return  boolean
	 */
	public function delete(UserDataInterface $user)
	{
		return $this->getDataMapper()->delete(array('id' => $user->id));
	}

	/**
	 * login
	 *
	 * @param UserDataInterface|UserData $user
	 *
	 * @return  boolean
	 */
	public function login(UserDataInterface $user)
	{
		$session = Ioc::getSession();

		$session->set('user', (array) $user);

		return true;
	}

	/**
	 * logout
	 *
	 * @param UserDataInterface|UserData $user
	 *
	 * @return bool
	 */
	public function logout(UserDataInterface $user)
	{
		$session = Ioc::getSession();

		$session->remove('user');

		return true;
	}

	/**
	 * getDataMapper
	 *
	 * @return  DataMapper
	 */
	protected function getDataMapper()
	{
		if (!$this->mapper)
		{
			$this->mapper = new DataMapper('users');
		}

		return $this->mapper;
	}
}
 
