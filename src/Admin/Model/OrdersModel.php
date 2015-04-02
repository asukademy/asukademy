<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Riki\Model\ListModel;
use Windwalker\Query\Query;
use Windwalker\Query\QueryElement;
use Windwalker\Table\Table;

/**
 * The OrdersModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrdersModel extends ListModel
{
	/**
	 * getListQuery
	 *
	 * @param Query $query
	 *
	 * @return  Query
	 */
	protected function getListQuery(Query $query)
	{
		$queryHelper = $this->getQueryHelper();

		$queryHelper->addTable('order', Table::ORDERS)
			->addTable('plan', Table::PLANS, 'plan.id = order.plan_id')
			->addTable('stage', Table::STAGES, 'stage.id = plan.stage_id')
			->addTable('course', Table::COURSES, 'course.id = stage.course_id')
			->addTable('category', Table::CATEGORIES, 'category.id = course.catid')
			->addTable('user', Table::USERS, 'user.id = order.user_id');

		$query->select($queryHelper->getSelectFields());

		$query = $queryHelper->registerQueryTables($query);

		if ($this['list.search'])
		{
			$search[] = $query->format('%n LIKE %q', 'course.title', '%' . $this['list.search'] . '%');

			$query->where(new QueryElement('()', $search, ' OR '));
		}

		if ($this['filter.stage_id'])
		{
			$query->where('stage.id = ' . $this['filter.stage_id']);
		}

		if ($this['list.ordering'])
		{
			$query->order($this['list.ordering']);
		}

		return $query;
	}
}
