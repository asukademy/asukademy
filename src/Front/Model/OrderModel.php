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
class OrderModel extends \Admin\Model\OrderModel
{
	/**
	 * getItem
	 *
	 * @param integer $pk
	 *
	 * @return  mixed|Data
	 */
	public function getPlan($pk = null)
	{
		return $this->fetch('plan', function() use ($pk)
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
}
