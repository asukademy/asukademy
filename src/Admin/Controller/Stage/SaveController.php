<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Stage;

use Admin\Model\StageModel;
use Admin\Record\StageRecord;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;

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

		$courseId = $this->input->get('course_id');
		$data = $this->input->post->getVar('stage');

		$data = new Data($data);

		// Store Session
		$temp = clone $data;

		$session->set('stage.edit.data' . $temp->id, $temp);

		try
		{
			if (!$this->validate($data))
			{
				return false;
			}

			// Prepare default data
			// -----------------------------------------
			$data->course_id = $courseId;
			// -----------------------------------------

			$record = new StageRecord;

			$record->load($data->id);

			$record->bind($data)
				->check()
				->store(true);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:stage', ['id' => $data->id, 'course_id' => $courseId]), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:stage', ['id' => $data->id, 'course_id' => $courseId]), 'Save fail', 'danger');

			return false;
		}

		// Save success, reset user session
		$session->remove('stage.edit.data' . $temp->id);

		$this->setRedirect(Router::buildHttp('admin:stage', ['id' => $record->id, 'course_id' => $courseId]), 'Save Success', 'success');

		return true;
	}

	/**
	 * postExecute
	 *
	 * @param mixed $result
	 *
	 * @return  mixed
	 */
	protected function postExecute($result = null)
	{
//		if (!$result)
//		{
//			return $result;
//		}
//
//		// Save tutors
//		$tutors = $this->input->getByPath('stage.tutors', [], 'array');
//
//		$mapper = new DataMapper(Table::TUTOR_COURSE_MAPS);
//
//		$dataset = [];
//
//
//		$mapper->flush()

		return $result;
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
		$model = new StageModel;

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
