<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\User;

use Windwalker\Core\Authenticate\UserData;
use Windwalker\Core\Authenticate\UserDataInterface;
use Windwalker\Core\Authenticate\UserHandlerInterface;
use Windwalker\Core\Ioc;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

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
		if ($user->id)
		{
			$data = $this->getDataMapper()->findOne($user->id);

			$data->bind($user->dump());

			$this->getDataMapper()->updateOne($data, 'id', true);
		}
		else
		{
			$data = new Data($user->dump());

			$this->getDataMapper()->createOne($data);
		}

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
 
