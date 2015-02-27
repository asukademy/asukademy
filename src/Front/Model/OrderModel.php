<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Model;

use Admin\Helper\TransactionHelper;
use Front\Form\OrderFieldDefinition;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Form;
use Windwalker\Ioc;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The OrderModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderModel extends DatabaseModel
{
	protected $plan;
	protected $stage;

	/**
	 * getItem
	 *
	 * @param integer $pk
	 *
	 * @return  mixed|Data
	 */
	public function getPlan($pk = null)
	{
		return $this->fetch('item', function() use ($pk)
		{
			$pk = $pk ? : $this['item.id'];

			if (!$pk)
			{
				return new Data;
			}

			$item = (new DataMapper(Table::PLANS))->findOne($pk);

			if ($item->isNull())
			{
				return $item;
			}

			$item->stage = (new DataMapper(Table::STAGES))->findOne($item->stage_id);
			$item->course = (new DataMapper(Table::COURSES))->findOne($item->stage->course_id);

			return $item;
		});
	}

	/**
	 * getForm
	 *
	 * @param bool $loadData
	 *
	 * @return Form
	 */
	public function getForm($loadData = false)
	{
		$form = new Form('user');

		$form->defineFormFields(new OrderFieldDefinition);

		$session = Ioc::getSession();

		$data = $session->get('order.create.data' . $this['item.id']);
		$data = $data ? : User::get();

		if ($data)
		{
			$form->bind($data);

			$session->remove('order.create.data');
		}

		return $form;
	}

	/**
	 * save
	 *
	 * @param   Data  $data
	 *
	 * @return  bool
	 *
	 * @throws ValidFailException
	 */
	public function save($data)
	{
		if (!$this->checkQuantity())
		{
			throw new ValidFailException('本次開課已額滿');
		}

		$record = new Record(Table::ORDERS);

		$record->load($data->id)
			->bind($data)
			->check()
			->store();

		$this->addQuantity();

		$this['item.id'] = $record->id;

		return true;
	}

	/**
	 * getTotalFroUpdate
	 *
	 * @param string $table
	 * @param int    $id
	 *
	 * @return  mixed
	 */
	public function getTotalForUpdate($table, $id)
	{
		return $this->fetch($table . '.' . $id, function() use ($table, $id)
		{
			$db = Ioc::getDatabase();

			$query = $db->getQuery(true);

			$query->select('*')
				->from($table)
				->where('id = ' . $id);

			$query = $query . ' FOR UPDATE';

			return $db->setQuery($query)->loadOne();
		});
	}

	/**
	 * checkQuantity
	 *
	 * @return  bool
	 */
	public function checkQuantity()
	{
		$plan = static::getTotalForUpdate(Table::PLANS, $this['item.id']);
		$stage = static::getTotalForUpdate(Table::STAGES, $plan->stage_id);

		if ($stage->quota && ($stage->total >= $stage->quota))
		{
			return false;
		}

		if ($plan->quota && ($plan->total >= $plan->quota))
		{
			return false;
		}

		return true;
	}

	/**
	 * addQuantity
	 *
	 * @param int $plus
	 *
	 * @return  bool
	 */
	public function addQuantity($plus = 1)
	{
		$plan = static::getTotalForUpdate(Table::PLANS, $this['item.id']);
		$stage = static::getTotalForUpdate(Table::STAGES, $plan->stage_id);

		$query = $this->db->getQuery(true);

		$query->update(Table::PLANS)
			->set('total = total + ' . $plus)
			->where('id = ' . $plan->id);

		$this->db->setQuery($query)->execute();

		$query = $this->db->getQuery(true);

		$query->update(Table::STAGES)
			->set('total = total + ' . $plus)
			->where('id = ' . $stage->id);

		$this->db->setQuery($query)->execute();

		return true;
	}
}