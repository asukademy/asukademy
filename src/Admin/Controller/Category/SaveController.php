<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Category;

use Riki\Controller\AbstractSaveController;
use Windwalker\Data\Data;
use Windwalker\Filter\OutputFilter;
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
	 * preSave
	 *
	 * @param Data $data
	 *
	 * @return  void
	 */
	protected function preSave(Data $data)
	{
		$data->alias = $data->alias ? : OutputFilter::stringURLUnicodeSlug($data->title);

		if (!$data->id)
		{
			$data->ordering = $this->model->getMaxOrdering() + 1;
		}
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
		$record = new Record(Table::CATEGORIES);

		$record->load($data->id)
			->bind($data)
			->check()
			->store(Record::UPDATE_NULLS);

		$data->id = $record->id;
	}

	/**
	 * postSave
	 *
	 * @param Data $data
	 *
	 * @return  void
	 */
	protected function postSave(Data $data)
	{
	}
}
