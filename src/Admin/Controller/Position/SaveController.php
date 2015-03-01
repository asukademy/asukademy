<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Position;

use Riki\Controller\AbstractSaveController;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Data\Data;
use Windwalker\Form\Form;
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
	 * @return void
	 */
	protected function doSave(Data $data)
	{
		$record = new Record(Table::POSITIONS);

		$record->load($data->id)
			->bind($data)
			->check()
			->store(Record::UPDATE_NULLS);

		$data->id = $record->id;
	}
}
