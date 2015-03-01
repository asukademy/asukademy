<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\CategoryFieldDefinition;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Table\Table;

/**
 * The CategoryModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CategoryModel extends AbstractFormModel
{
	/**
	 * getDefaultTable
	 *
	 * @return  string
	 */
	public function getDefaultTable()
	{
		return Table::CATEGORIES;
	}

	/**
	 * getFieldDefinition
	 *
	 * @return  FieldDefinitionInterface
	 */
	protected function getFieldDefinition()
	{
		return new CategoryFieldDefinition;
	}
}
