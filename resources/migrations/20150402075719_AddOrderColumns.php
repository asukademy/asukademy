<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Table\Table;

/**
 * Migration class, version: 20150402075719
 */
class AddOrderColumns extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable(Table::ORDERS, true)
			->addColumn(new Column\Datetime('checked_in', Column::ALLOW_NULL, null, '', ['position' => 'after state']))
			->addColumn(new Column\Varchar('vat', 255, Column::ALLOW_NULL, null, '', ['position' => 'after organization']))
			->addColumn(new Column\Varchar('invoice', 255, Column::ALLOW_NULL, null, '', ['position' => 'after checked_in']))
			->update();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable(Table::ORDERS, true)
			->dropColumn('checked_in')
			->dropColumn('vat')
			->dropColumn('invoice');
	}
}
