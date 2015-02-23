<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\User;

use Admin\Model\UserModel;
use Admin\Record\UserRecord;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\Ioc;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$session = Ioc::getSession();

		$data = $this->input->post->getVar('user');

		$data = new Data($data);

		// Store Session
		$temp = clone $data;
		unset($temp->password);
		unset($temp->password2);

		$session->set('user.edit.data', $temp);

		try
		{
			if (!$this->validate($data))
			{
				return false;
			}

			// Prepare default data
			$data->registered = (new \DateTime('now', new \DateTimeZone('Asia/Taipei')))->format('Y-m-d H:i:s');

			$record = new UserRecord;

			$record->load($data->id);

			$record->bind($data)
				->check()
				->store(true);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:user', ['id' => $data->id ? : '']), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:user', ['id' => $data->id]), 'Save fail', 'danger');

			return false;
		}

		// Save success, reset user session
		unset($data->password);
		unset($data->password2);
		$session->remove('user.edit.data');

		$this->setRedirect(Router::buildHttp('admin:users'), 'Save Success', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @throws  ValidFailException
	 * @return  boolean
	 */
	protected function validate($data)
	{
		$model = new UserModel;

		$form = $model->getForm($data);

		if (!$form->validate())
		{
			$errors = $form->getErrors();

			foreach ($errors as $error)
			{
				$this->addFlash($error->getMessage(), 'danger');
			}

			$this->setRedirect(Router::buildHttp('admin:user', ['id' => $data->id]));

			return false;
		}

		if ($data->password)
		{
			if ($data->password2 != $data->password)
			{
				throw new ValidFailException('Password not match');
			}

			$password = new Password;

			$data->password = $password->create($data->password);
		}

		return true;
	}
}
