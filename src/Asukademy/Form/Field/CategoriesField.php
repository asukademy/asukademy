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
class CategoriesField extends ListField
{
	/**
	 * prepareOptions
	 *
	 * @return  array|Option
	 */
	protected function prepareOptions()
	{
		$categories = (new DataMapper(Table::CATEGORIES))->findAll();

		$options = [];

		foreach ($categories as $category)
		{
			$options[] = new Option($category->title, $category->id);
		}

		return $options;
	}
}
