<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Model;

use Admin\Mapper\StageMapper;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The StageModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StageModel extends DatabaseModel
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

			$item = (new StageMapper)->findOne($pk);

			if ($item->isNull())
			{
				return new Data;
			}

			$item->course   = (new DataMapper(Table::COURSES))->findOne($item->course_id);
			$item->category = (new DataMapper(Table::CATEGORIES))->findOne($item->course->catid);

			// $planMapper     = new DataMapper(Table::PLANS);
			$classMapper    = new DataMapper(Table::CLASSES);
			$positionMapper = new DataMapper(Table::POSITIONS);
			// $orderMapper    = new DataMapper(Table::ORDERS);

			// $item->plans    = $planMapper->find(['stage_id' => $item->id, 'state >= 1']);
			$item->classes  = $classMapper->find(['stage_id' => $item->id, 'state >= 1']);
			$item->position = $positionMapper->findOne(['id' => $item->position_id]);
			// $item->orders   = $orderMapper->find(['stage_id' => $item->id, 'state >= 2']);

			return $item;
		});
	}

	/**
	 * getPlans
	 *
	 * @param int $stageId
	 *
	 * @return  mixed|Data|\Windwalker\Data\DataSet
	 */
	public function getPlans($stageId = null)
	{
		$stage = $this->getItem($stageId);

		if ($stage->isNull())
		{
			return $stage;
		}

		$plans = (new DataMapper(Table::PLANS))->find(['stage_id' => $stage->id, 'state >= 1']);

		if ($plans->isNull())
		{
			return $plans;
		}

		$orderMapper = new DataMapper(Table::ORDERS);

		foreach ($plans as $plan)
		{
			$plan->orders = $orderMapper->find(['plan_id' => $plan->id, 'state >= 2']);
		}

		return $plans;
	}
}
