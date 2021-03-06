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
 * The PositionsModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PositionsModel extends ListModel
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

		$queryHelper->addTable('position', Table::POSITIONS);

		$query->select($queryHelper->getSelectFields());

		$query = $queryHelper->registerQueryTables($query);

		if ($this['list.search'])
		{
			$search[] = $query->format('%n LIKE %q', 'position.title', '%' . $this['list.search'] . '%');

			$query->where(new QueryElement('()', $search, ' OR '));
		}

		if ($this['list.ordering'])
		{
			$query->order($this['list.ordering']);
		}

		return $query;
	}
}
