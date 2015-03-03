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
use Asukademy\Session\CSRFToken;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filter\OutputFilter;
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
	 * @return  mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		CSRFToken::validate();

		$session = Ioc::getSession();

		$data = $this->input->post->getVar('course');

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
			$data->alias = $data->alias ? : $data->title;

			$data->alias = OutputFilter::stringURLUnicodeSlug($data->alias);

			if (!$data->id)
			{
				$data->ordering = (new CourseModel)->getMaxOrdering(['catid' => $data->catid]) + 1;
			}
			// -----------------------------------------

			$record = new CourseRecord;

			$record->load($data->id);

			$record->bind($data)
				->check()
				->store(true);

			$this->postSave($record);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:course', ['id' => $data->id ? : '']), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:course', ['id' => $data->id]), 'Save fail', 'danger');

			return false;
		}

		// Save success, reset user session
		$session->remove('course.edit.data' . $temp->id);

		$this->setRedirect(Router::buildHttp('admin:course', ['id' => $record->id]), 'Save Success', 'success');

		return true;
	}

	/**
	 * postSave
	 *
	 * @return  void
	 */
	public function postSave($record)
	{
		$tutors = $this->input->post->getByPath('course.tutors', [], 'array');

		$mapper = new DataMapper(Table::TUTOR_COURSE_MAPS);

		$dataset = new DataSet;

		foreach ($tutors as $tutor)
		{
			$dataset[] = ['tutor_id' => $tutor, 'course_id' => $record->id];
		}

		$mapper->flush($dataset, ['course_id' => $record->id]);
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
