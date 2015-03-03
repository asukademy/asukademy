<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Model;

use Admin\Mapper\CourseMapper;
use Admin\Mapper\StageMapper;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\Data\DataSet;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The CourseModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseModel extends DatabaseModel
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

			return (new CourseMapper)->findOne($pk);
		});
	}

	/**
	 * getStages
	 *
	 * @param int $courseId
	 *
	 * @return  mixed|DataSet
	 */
	public function getStages($courseId = null)
	{
		$courseId = $courseId ? : $this->getItem()->id;

		if (!$courseId)
		{
			return new DataSet;
		}

		$stages = (new StageMapper)->find(['state >= 1', 'course_id' => $courseId, sprintf('start > "%s"', gmdate('Y-m-d H:i:s'))], 'start asc');

		$planMapper     = new DataMapper(Table::PLANS);
		$classMapper    = new DataMapper(Table::CLASSES);
		$positionMapper = new DataMapper(Table::POSITIONS);
		$orderMapper    = new DataMapper(Table::ORDERS);

		foreach ($stages as $stage)
		{
			$stage->plans    = $planMapper->find(['stage_id' => $stage->id, 'state >= 1']);
			$stage->classes  = $classMapper->find(['stage_id' => $stage->id, 'state >= 1']);
			$stage->position = $positionMapper->findOne(['id' => $stage->position_id]);
			$stage->orders   = $orderMapper->find(['stage_id' => $stage->id, 'state >= 2']);
		}

		return $stages;
	}
}
