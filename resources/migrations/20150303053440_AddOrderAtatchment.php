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
 * Migration class, version: 20150303053440
 */
class AddOrderAtatchment extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->setQuery('ALTER TABLE `orders` ADD `attachment` varchar(255) DEFAULT ""')->execute();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable(\Windwalker\Table\Table::ORDERS, true)
			->dropColumn('attachment');
	}
}
