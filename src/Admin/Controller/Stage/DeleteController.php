<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Stage;

use Admin\Record\StageRecord;
use Riki\Controller\AbstractSaveController;
use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The DeleteController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DeleteController extends AbstractSaveController
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
		$record = new StageRecord;

		$record->load($data->id);

		$record->delete();

		$data->bind($record);
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
