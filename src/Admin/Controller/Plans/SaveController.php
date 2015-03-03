<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Plans;

use Asukademy\Session\CSRFToken;
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
	 * Property data.
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		CSRFToken::validate();

		$this->data = $this->input->getVar('plan');
	}

	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$stageId  = $this->input->get('stage_id');
		$courseId = $this->input->get('course_id');

		$db = Ioc::getDatabase();

		$trans = $db->getTransaction()->start();

		try
		{
			foreach ($this->data as $k => &$plan)
			{
				$plan['stage_id'] = $stageId;
				$plan['state'] = !empty($plan['enabled']);

				$this->save($plan, $k);
			}
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$this->setRedirect($this->returnUrl(), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect($this->returnUrl(), 'Save fail', 'danger');

			return false;
		}

		$trans->commit();

		$this->setRedirect($this->returnUrl(), 'Save Success', 'success');

		return true;
	}

	/**
	 * save
	 *
	 * @param array $data
	 * @param int   $k
	 *
	 * @throws ValidFailException
	 */
	protected function save($data, $k)
	{
		$mapper = new DataMapper(Table::PLANS);

		$data = new Data($data);

		if (!$data->title && $data->enabled)
		{
			throw new ValidFailException(sprintf('第 %s 個方案沒有輸入方案名稱', $k));
		}

		$data->state = (bool) $data->enabled;

		$mapper->saveOne($data, ['id', 'stage_id'], true);
	}

	/**
	 * postExecute
	 *
	 * @param bool $result
	 *
	 * @return  bool
	 */
	protected function postExecute($result = null)
	{
		if (!$result)
		{
			$session = Ioc::getSession();

			$session->set('plans.edit.data', $this->data);
		}

		return $result;
	}

	/**
	 * returnUrl
	 *
	 * @return  string
	 */
	protected function returnUrl()
	{
		$stageId  = $this->input->get('stage_id');
		$courseId = $this->input->get('course_id');

		return Router::buildHttp('admin:plans', ['course_id' => $courseId, 'stage_id' => $stageId]);
	}
}
