<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Course;

use Admin\Model\CourseModel;
use Admin\Record\CourseRecord;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
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
	 * @return  mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$session = Ioc::getSession();

		$data = $this->input->post->getVar('user');

		$data = new Data($data);

		// Store Session
		$temp = clone $data;

		$session->set('course.edit.data' . $temp->id, $temp);

		try
		{
			if (!$this->validate($data))
			{
				return false;
			}

			// Prepare default data
			// -----------------------------------------

			// -----------------------------------------

			$record = new CourseRecord;

			$record->load($data->id);

			$record->bind($data)
				->check()
				->store(true);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:course', ['id' => $data->id ? : '']), $e->getMessage(), 'danger');

			return true;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:course', ['id' => $data->id]), 'Save fail', 'danger');

			return true;
		}

		// Save success, reset user session
		$session->remove('course.edit.data' . $temp->id);

		$this->setRedirect(Router::buildHttp('admin:course', ['id' => $record->id]), 'Save Success', 'success');

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
		$model = new CourseModel;

		$form = $model->getForm($data);

		if (!$form->validate())
		{
			$errors = $form->getErrors();

			$msgs = array();

			foreach ($errors as $error)
			{
				$msgs[] = $error->getMessage();
			}

			throw new ValidFailException(implode("<br >", $msgs));
		}

		return true;
	}
}
