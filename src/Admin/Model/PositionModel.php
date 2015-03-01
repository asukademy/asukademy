<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\PositionFieldDefinition;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Table\Table;

/**
 * The PositionModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PositionModel extends AbstractFormModel
{
	/**
	 * getDefaultTable
	 *
	 * @return  string
	 */
	public function getDefaultTable()
	{
		return Table::POSITIONS;
	}

	/**
	 * getFieldDefinition
	 *
	 * @return  FieldDefinitionInterface
	 */
	protected function getFieldDefinition()
	{
		return new PositionFieldDefinition;
	}
}
