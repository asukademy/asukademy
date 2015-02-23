<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Classes;

use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Core\Utilities\Iterator\PriorityQueue;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;
use Windwalker\Utilities\ArrayHelper;

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
		$this->data = $this->input->getVar('classes');
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
			$dataset = new DataSet($this->data);
			$dataset = $this->removeEmpty($dataset);
			$dataset = $this->reorder($dataset);

			foreach ($dataset as $k => $class)
			{
				$class['stage_id'] = $stageId;
				$class['state'] = !empty($class['enabled']);

				$this->validate($class, $k + 1);
			}

			$mapper = new DataMapper(Table::CLASSES);

			$mapper->flush($dataset, ['stage_id' => $this->input->get('stage_id')]);
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
	 * removeEmpty
	 *
	 * @param array $dataset
	 *
	 * @return  DataSet
	 */
	protected function removeEmpty($dataset)
	{
		foreach ($dataset as $k => $data)
		{
			if (empty($data['title']) && empty($data['enabled']))
			{
				unset($dataset[$k]);
			}
		}

		return $dataset;
	}

	/**
	 * reorder
	 *
	 * @param array $dataset
	 *
	 * @return  DataSet
	 */
	protected function reorder($dataset)
	{
		$tmp = 0;

		$queue = new PriorityQueue;

		// Fill the empty
		foreach ($dataset as $data)
		{
			$order = $data->ordering;

			if (!$order)
			{
				$order = ++$tmp;
			}

			$tmp = $order;

			$queue->insert($data, -$order);
		}

		$i = 1;
		$new = [];

		foreach ($queue as $data)
		{
			$data['ordering'] = $i;

			$new[] = $data;

			$i++;
		}

		return new DataSet($new);
	}

	/**
	 * save
	 *
	 * @param Data $data
	 * @param int   $k
	 *
	 * @throws ValidFailException
	 */
	protected function validate($data, $k)
	{
		if (!$data->title && $data->enabled)
		{
			throw new ValidFailException(sprintf('第 %s 個課程沒有輸入名稱', $k));
		}

		if (($data->start && !$data->end) || (!$data->start && $data->end))
		{
			throw new ValidFailException(sprintf('第 %s 個課程必須同時有開始與結束時間，或者都留空', $k));
		}

		if ($data->end && $data->start && strcmp($data->end, $data->start) <= 0)
		{
			throw new ValidFailException(sprintf('第 %s 個課程的結束時間必須比開始時間晚', $k));
		}

		if (!$data->date && ($data->start || $data->end))
		{
			throw new ValidFailException(sprintf('第 %s 個課程只有時段沒有日期是無意義的', $k));
		}

		if ($data->start && $data->end && !$data->hours)
		{
			$data->hours = $data->end - $data->start;
		}

		$data->state = (bool) $data->enabled;
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

			foreach ($this->data as $k => &$class)
			{
				$class['state'] = !empty($class['enabled']);
			}

			$session->set('classes.edit.data', $this->data);
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

		return Router::buildHttp('admin:classes', ['course_id' => $courseId, 'stage_id' => $stageId]);
	}
}
