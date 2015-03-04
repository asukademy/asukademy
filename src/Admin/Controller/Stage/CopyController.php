<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Stage;

use Riki\Controller\AbstractSaveController;
use Windwalker\Data\Data;
use Windwalker\Record\Record;
use Windwalker\String\String;
use Windwalker\Table\Table;

/**
 * The CopyController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CopyController extends AbstractSaveController
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
		$record = new Record(Table::STAGES);

		$record->load($data->id);

		$record->id = null;
		$record->state = 0;
		$record->title = String::increment($record->title);

		$record->check()
			->store();

		$data->bind($record->toArray());
	}

	/**
	 * getFailRedirect
	 *
	 * @param  Data $data
	 *
	 * @return  string
	 */
	protected function getFailRedirect(Data $data)
	{
		return $this->package->router->buildHttp('course', ['id' => $data->course_id]);
	}

	/**
	 * getSuccessRedirect
	 *
	 * @param  Data $data
	 *
	 * @return  string
	 */
	protected function getSuccessRedirect(Data $data)
	{
		return $this->package->router->buildHttp('course', ['id' => $data->course_id]);
	}
}
