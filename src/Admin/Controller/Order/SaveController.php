<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Order;

use Riki\Controller\AbstractSaveController;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Data\Data;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractSaveController
{
	/**
	 * doSave
	 *
	 * @param Data $data
	 *
	 * @return bool
	 */
	protected function doSave(Data $data)
	{
		$record = new Record(Table::ORDERS);

		$tmp = $data->state;

		unset($data->state);

		$record->load($data->id)
			->bind($data)
			->check()
			->store(Record::UPDATE_NULLS);

		$data->state = $tmp;
		$data->id = $record->id;

		return true;
	}

	/**
	 * postSave
	 *
	 * @param Data $data
	 *
	 * @return bool
	 * @throws ValidFailException
	 */
	protected function postSave(Data $data)
	{
		if (!$this->hmvc($ctrl = new StateController, ['id' => $data->id, 'state' => [$data->id => $data->state]]))
		{
			$rdr = $ctrl->getRedirect();

			throw new ValidFailException($rdr['msg']);
		}

		return true;
	}

	protected function validate(Data $data)
	{
		if (!$data->name)
		{
			throw new ValidFailException('需要名字');
		}

		if (!$data->email)
		{
			throw new ValidFailException('需要 Email');
		}
	}
}
