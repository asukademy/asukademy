<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;

/**
 * Migration class, version: 20150301141822
 */
class AddCourseOrdering extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable(\Windwalker\Table\Table::COURSES, true)
			->addColumn(new Column\Integer('ordering', 11, Column::UNSIGNED, Column::NOT_NULL, 0, '', ['after' => 'state']))
			->update();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable(\Windwalker\Table\Table::COURSES, true)
			->dropColumn('ordering');
	}
}
