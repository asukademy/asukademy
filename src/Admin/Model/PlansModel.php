<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\DataSet;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;

/**
 * The PlansModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PlansModel extends DatabaseModel
{
	/**
	 * getItems
	 *
	 * @return  \Windwalker\Data\DataSet
	 */
	public function getItems()
	{
		$session = Ioc::getSession();

		$items = $session->get('plans.edit.data');

		if ($items)
		{
			$session->remove('plans.edit.data');

			$items = new DataSet($items);

			return $items;
		}

		$conditions = ['stage_id' => $this['stage.id']];

		return (new DataMapper(Table::PLANS))->find($conditions);
	}
}
