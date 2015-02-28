<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Model;

use Riki\Model\ListModel;
use Windwalker\Core\Authenticate\User;
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
			->addTable('category', Table::CATEGORIES, 'category.id = course.catid');

		$query->select($queryHelper->getSelectFields());

		$query = $queryHelper->registerQueryTables($query);

		// Filter
		// ---------------------------------
		$user = User::get();

		$query->where('order.user_id =' . $user->id);

		// Search
//		if ($searches = $this['list.search'])
//		{
//			$search = [];
//
//			foreach (explode(' ', $searches) as $text)
//			{
//				if (!trim($text))
//				{
//					continue;
//				}
//
//				$search[] = $query->format('%n LIKE %q', 'course.title', '%' . $text . '%');
//				$search[] = $query->format('%n LIKE %q', 'course.introtext', '%' . $text . '%');
//				$search[] = $query->format('%n LIKE %q', 'course.fulltext', '%' . $text . '%');
//				$search[] = $query->format('%n LIKE %q', 'category.title', '%' . $text . '%');
//			}
//
//			$query->where(new QueryElement('()', $search, ' OR '));
//		}

		if ($this['list.ordering'])
		{
			$query->order($this['list.ordering']);
		}

		return $query;
	}
}
