<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Form\Field;

use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Field\ListField;
use Windwalker\Html\Option;
use Windwalker\Table\Table;

/**
 * The CategoriesField class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ItemlistField extends ListField
{
	/**
	 * prepareOptions
	 *
	 * @return  array|Option
	 */
	protected function prepareOptions()
	{
		$ordering = $this->get('ordering', null);
		$start    = $this->get('start', null);
		$limit    = $this->get('limit', null);

		$categories = (new DataMapper($this->get('table')))->findAll($ordering, $start, $limit);

		$titleField = $this->get('title_field', 'title');
		$valueField = $this->get('value_field', 'id');

		$options = [];

		foreach ($categories as $category)
		{
			$options[] = new Option($category->$titleField, $category->$valueField);
		}

		return $options;
	}
}
