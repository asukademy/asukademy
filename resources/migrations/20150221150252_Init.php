<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column;
use Windwalker\Database\Schema\DataType;
use Windwalker\Table\Table;

/**
 * Migration class, version: 20150221150252
 */
class Init extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable(Table::USERS)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Varchar('name'))
			->addColumn(new Column\Varchar('username'))
			->addColumn(new Column\Varchar('password'))
			->addColumn(new Column\Integer('group'))
			->addColumn(new Column\Varchar('email'))
			->addColumn(new Column\Varchar('nick'))
			->addColumn(new Column\Char('mobile', 15))
			->addColumn(new Column\Char('phone'), 20)
			->addColumn(new Column\Varchar('address'))
			->addColumn(new Column\Varchar('organization'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Varchar('activation'))
			->addColumn(new Column\Timestamp('registered'))
			->addColumn(new Column\Timestamp('last_login'))
			->addColumn(new Column\Varchar('reset_password'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::CATEGORIES)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('alias'))
			->addColumn(new Column\Varchar('eng_title'))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Integer('ordering'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::COURSES)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('catid'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('alias'))
			->addColumn(new Column\Varchar('subtitle'))
			->addColumn(new Column\Varchar('image'))
			->addColumn(new Column\Text('introtext'))
			->addColumn(new Column\Text('fulltext'))
			->addColumn(new Column\Text('learned'))
			->addColumn(new Column\Text('target'))
			->addColumn(new Column\Text('note'))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::STAGES)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('alias'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Varchar('position_id'))
			->addColumn(new Column\Integer('quota', 11, Column::UNSIGNED, Column::ALLOW_NULL))
			->addColumn(new Column\Integer('total', 11, Column::UNSIGNED, Column::NOT_NULL, 0))
			->addColumn(new Column\Integer('less', 11, Column::UNSIGNED, Column::ALLOW_NULL))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Timestamp('start'))
			->addColumn(new Column\Timestamp('end'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::TUTORS)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('user_id'))
			->addColumn(new Column\Varchar('name'))
			->addColumn(new Column\Varchar('nick'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Text('experience'))
			->addColumn(new Column\Varchar('image'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::TUTOR_COURSE_MAPS)
			->addColumn(new Column\Integer('tutor_id'))
			->addColumn(new Column\Integer('course_id'))
			->create(true);

		$this->db->getTable(Table::TUTOR_STAGE_MAPS)
			->addColumn(new Column\Integer('tutor_id'))
			->addColumn(new Column\Integer('stage_id'))
			->create(true);

		$this->db->getTable(Table::PLANS)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('stage_id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn('price', DataType::DECIMAL)
			->addColumn('origin_price', DataType::DECIMAL, Column::UNSIGNED, Column::ALLOW_NULL, null)
			->addColumn(new Column\Tinyint('state'))
			->addColumn(new Column\Timestamp('start'))
			->addColumn(new Column\Timestamp('end'))
			->addColumn(new Column\Integer('quota', 11, Column::UNSIGNED, Column::ALLOW_NULL))
			->addColumn(new Column\Integer('total', 11, Column::UNSIGNED, Column::NOT_NULL, 0))
			->addColumn(new Column\Integer('max_one_time', 11, Column::UNSIGNED, Column::ALLOW_NULL))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::CLASSES)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('stage_id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn('date', DataType::DATE, Column::SIGNED, Column::ALLOW_NULL, '')
			->addColumn(new Column\Char('start', 5, Column::ALLOW_NULL))
			->addColumn(new Column\Char('end', 5, Column::ALLOW_NULL))
			->addColumn(new Column\Char('hours', 6))
			->addColumn(new Column\Text('intro'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Integer('ordering'))
			->addColumn(new Column\Tinyint('state'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::POSITIONS)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('url'))
			->addColumn(new Column\Varchar('address'))
			->addColumn(new Column\Varchar('map'))
			->addColumn(new Column\Varchar('image'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Text('note'))
			->addColumn(new Column\Tinyint('state'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::ORDERS)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('user_id'))
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Integer('stage_id'))
			->addColumn(new Column\Integer('plan_id'))
			->addColumn(new Column\Varchar('plan_title'))
			->addColumn('price', DataType::DECIMAL)
			->addColumn(new Column\Varchar('name'))
			->addColumn(new Column\Varchar('email'))
			->addColumn(new Column\Varchar('nick'))
			->addColumn(new Column\Char('mobile', 15))
			->addColumn(new Column\Char('phone'), 20)
			->addColumn(new Column\Varchar('address'))
			->addColumn(new Column\Varchar('organization'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Tinyint('state', 1, Column::SIGNED))
			->addColumn(new Column\Datetime('created'))
			->addColumn(new Column\Varchar('payment'))
			->addColumn(new Column\Datetime('expire_time'))
			->addColumn(new Column\Datetime('paid_time'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable(Table::TAGS)
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Varchar('title'))
			->create(true);
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable(Table::CATEGORIES)->drop(true);
		$this->db->getTable(Table::CLASSES)->drop(true);
		$this->db->getTable(Table::COURSES)->drop(true);
		$this->db->getTable(Table::ORDERS)->drop(true);
		$this->db->getTable(Table::PLANS)->drop(true);
		$this->db->getTable(Table::POSITIONS)->drop(true);
		$this->db->getTable(Table::STAGES)->drop(true);
		$this->db->getTable(Table::TAGS)->drop(true);
		$this->db->getTable(Table::TUTOR_COURSE_MAPS)->drop(true);
		$this->db->getTable(Table::TUTOR_STAGE_MAPS)->drop(true);
		$this->db->getTable(Table::TUTORS)->drop(true);
		$this->db->getTable(Table::USERS)->drop(true);
	}
}
