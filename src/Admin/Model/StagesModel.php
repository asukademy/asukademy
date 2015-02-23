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
 * The StagesModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StagesModel extends ListModel
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'stages';

	/**
	 * Property allowFields.
	 *
	 * @var  array
	 */
	protected $allowFields = ['filter.course_id'];

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

		$queryHelper->addTable('stage', Table::STAGES);
			// ->addTable('orders', Table::ORDERS, 'category.id = course.catid')
			// ->addTable('position', Table::POSITIONS, 'position.id = course.position_id');

		$query->select($queryHelper->getSelectFields());

		$query = $queryHelper->registerQueryTables($query);

		// Filter
		// ------------------------------------------
		if ($this['filter.course_id'] && $this->filterField('filter.course_id'))
		{
			$query->where($query->format('%n = %q', 'course_id', $this['filter.course_id']));
		}

		// Search
		// ------------------------------------------
		if ($this['list.search'])
		{
			$search[] = $query->format('%n LIKE %q', 'stage.title', '%' . $this['list.search'] . '%');

			$query->where(new QueryElement('()', $search, ' OR '));
		}

		if ($this['list.ordering'])
		{
			$query->order($this['list.ordering']);
		}

		return $query;
	}
}
