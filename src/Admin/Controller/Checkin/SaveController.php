<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Checkin;

use Asukademy\Helper\DateTimeHelper;
use Riki\Controller\AbstractSaveController;
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
	 * Property stage_id.
	 *
	 * @var int
	 */
	protected $stage_id;

	/**
	 * Property course_id.
	 *
	 * @var int
	 */
	protected $course_id;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		parent::prepareExecute();

		$this->stage_id = $this->input->get('stage_id');
		$this->course_id = $this->input->get('course_id');
	}

	/**
	 * doSave
	 *
	 * @param Data $data
	 *
	 * @return void
	 */
	protected function doSave(Data $data)
	{
		$record = new Record(Table::ORDERS);

		$record->id = $data->id;
		$record->checked_in = DateTimeHelper::format('now');

		//show($data, $record);die;

		$record->store();
	}

	/**
	 * getFailRedirect
	 *
	 * @param Data $data
	 *
	 * @return  string
	 */
	protected function getFailRedirect(Data $data)
	{
		return $this->package->router->buildHttp('checkin', ['course_id' => $this->course_id, 'stage_id' => $this->stage_id]);
	}

	/**
	 * getSuccessRedirect
	 *
	 * @param Data $data
	 *
	 * @return  string
	 */
	protected function getSuccessRedirect(Data $data)
	{
		return $this->package->router->buildHttp('checkin', ['course_id' => $this->course_id, 'stage_id' => $this->stage_id]);
	}
}
