<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Query\Mysql\MysqlQueryBuilder;
use Windwalker\Table\Table;

/**
 * Migration class, version: 20150302045518
 */
class ChangeTimestampToDatetime extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::STAGES, 'start', 'datetime', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::STAGES, 'end', 'datetime', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::PLANS, 'start', 'datetime', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::PLANS, 'end', 'datetime', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::USERS, 'registered', 'datetime', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::USERS, 'last_login', 'datetime', Column::SIGNED))
			->execute();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::STAGES, 'start', 'timestamp', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::STAGES, 'end', 'timestamp', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::PLANS, 'start', 'timestamp', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::PLANS, 'end', 'timestamp', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::USERS, 'registered', 'timestamp', Column::SIGNED))
			->execute();

		$this->db
			->setQuery(MysqlQueryBuilder::modifyColumn(Table::USERS, 'last_login', 'timestamp', Column::SIGNED))
			->execute();
	}
}
