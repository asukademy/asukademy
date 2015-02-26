<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Model;

use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The OrderModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderModel extends DatabaseModel
{
	/**
	 * getItem
	 *
	 * @param integer $pk
	 *
	 * @return  mixed|Data
	 */
	public function getItem($pk = null)
	{
		return $this->fetch('item', function() use ($pk)
		{
			$pk = $pk ? : $this['item.id'];

			if (!$pk)
			{
				return new Data;
			}

			$item = (new DataMapper(Table::ORDERS))->findOne($pk);

			if ($item->isNull())
			{
				return $item;
			}

			$item->plan = (new DataMapper(Table::PLANS))->findOne($item->plan_id);
			$item->stage = (new DataMapper(Table::STAGES))->findOne($item->stage_id);
			$item->course = (new DataMapper(Table::COURSES))->findOne($item->course_id);
			$item->category = (new DataMapper(Table::CATEGORIES))->findOne(['id' => $item->course->catid]);

			return $item;
		});
	}
}
