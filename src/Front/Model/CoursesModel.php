<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Model;

use Riki\Model\ListModel;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Query\Query;
use Windwalker\Query\QueryElement;
use Windwalker\Table\Table;

/**
 * The CoursesModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CoursesModel extends ListModel
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

		$queryHelper->addTable('course', Table::COURSES)
			->addTable('category', Table::CATEGORIES, 'category.id = course.catid');

		$query->select($queryHelper->getSelectFields());

		$query = $queryHelper->registerQueryTables($query);

		// Filter
		// ---------------------------------
		$category = $this->getCategory();

		if ($category->notNull())
		{
			$query->where('category.id = ' . $query->quote($category->id));
		}

		// Search
		if ($searches = $this['list.search'])
		{
			$search = [];

			foreach (explode(' ', $searches) as $text)
			{
				if (!trim($text))
				{
					continue;
				}

				$search[] = $query->format('%n LIKE %q', 'course.title', '%' . $text . '%');
				$search[] = $query->format('%n LIKE %q', 'course.introtext', '%' . $text . '%');
				$search[] = $query->format('%n LIKE %q', 'course.fulltext', '%' . $text . '%');
				$search[] = $query->format('%n LIKE %q', 'category.title', '%' . $text . '%');
			}

			$query->where(new QueryElement('()', $search, ' OR '));
		}

		if (!$this['filter.state'])
		{
			$query->where('course.state >= 1');
		}
		else
		{
			$query->where('course.state = ' . $this['filter.state']);
		}

		if ($this['list.ordering'])
		{
			$query->order($this['list.ordering']);
		}

		return $query;
	}

	/**
	 * getCategory
	 *
	 * @return  Data
	 */
	public function getCategory()
	{
		$state = $this->state;

		return $this->fetch('category', function() use ($state)
		{
			if (!$state['filter.category_alias'])
			{
				return new Data;
			}

			return (new DataMapper(Table::CATEGORIES))->findOne(['alias' => $this['filter.category_alias']]);
		});
	}
}
