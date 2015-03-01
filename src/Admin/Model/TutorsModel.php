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
 * The TutorsModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TutorsModel extends ListModel
{
	protected function getListQuery(Query $query)
	{
		$queryHelper = $this->getQueryHelper();

		$queryHelper->addTable('tutor', Table::TUTORS);;

		$query->select($queryHelper->getSelectFields());

		$query = $queryHelper->registerQueryTables($query);

		if ($this['list.search'])
		{
			$search[] = $query->format('%n LIKE %q', 'course.title', '%' . $this['list.search'] . '%');

			$query->where(new QueryElement('()', $search, ' OR '));
		}

		if ($this['list.ordering'])
		{
			$query->order($this['list.ordering']);
		}

		return $query;
	}
}
