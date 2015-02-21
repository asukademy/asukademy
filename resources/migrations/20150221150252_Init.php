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
		$this->db->getTable('users')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Varchar('name'))
			->addColumn(new Column\Varchar('username'))
			->addColumn(new Column\Varchar('password'))
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

		$this->db->getTable('categories')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('alias'))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Integer('ordering'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable('courses')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('catid'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('alias'))
			->addColumn(new Column\Varchar('subtitle'))
			->addColumn(new Column\Timestamp('start'))
			->addColumn(new Column\Timestamp('end'))
			->addColumn(new Column\Varchar('image'))
			->addColumn(new Column\Text('introtext'))
			->addColumn(new Column\Text('fulltext'))
			->addColumn(new Column\Varchar('position_id'))
			->addColumn(new Column\Integer('quota'))
			->addColumn(new Column\Integer('less'))
			->addColumn(new Column\Text('learned'))
			->addColumn(new Column\Text('target'))
			->addColumn(new Column\Text('note'))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable('tutors')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('user_id'))
			->addColumn(new Column\Varchar('name'))
			->addColumn(new Column\Varchar('nick'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Text('experience'))
			->addColumn(new Column\Varchar('image'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable('tutor_course_maps')
			->addColumn(new Column\Integer('tutor_id'))
			->addColumn(new Column\Integer('course_id'))
			->create(true);

		$this->db->getTable('plans')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn('price', DataType::DECIMAL, Column::UNSIGNED, Column::NOT_NULL, 0)
			->addColumn('origin_price', DataType::DECIMAL, Column::UNSIGNED, Column::NOT_NULL, 0)
			->addColumn(new Column\Tinyint('state'))
			->addColumn(new Column\Timestamp('start'))
			->addColumn(new Column\Timestamp('end'))
			->addColumn(new Column\Integer('quota'))
			->addColumn(new Column\Integer('max_one_time'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable('classes')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn('date', DataType::DATE, Column::SIGNED, Column::NOT_NULL, '')
			->addColumn(new Column\Char('start', 5))
			->addColumn(new Column\Char('end'), 5)
			->addColumn(new Column\Text('intro'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Integer('ordering'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable('positions')
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

		$this->db->getTable('orders')
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('user_id'))
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Integer('plan_id'))
			->addColumn(new Column\Varchar('plan_title'))
			->addColumn('price', DataType::DECIMAL, Column::UNSIGNED, Column::NOT_NULL, 0)
			->addColumn(new Column\Varchar('name'))
			->addColumn(new Column\Varchar('email'))
			->addColumn(new Column\Varchar('nick'))
			->addColumn(new Column\Char('mobile', 15))
			->addColumn(new Column\Char('phone'), 20)
			->addColumn(new Column\Varchar('address'))
			->addColumn(new Column\Varchar('organization'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Timestamp('created'))
			->addColumn(new Column\Varchar('payment'))
			->addColumn(new Column\Text('params'))
			->create(true);

		$this->db->getTable('tags')
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Varchar('title'))
			->create(true);
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable('categories')->drop(true);
		$this->db->getTable('classes')->drop(true);
		$this->db->getTable('courses')->drop(true);
		$this->db->getTable('orders')->drop(true);
		$this->db->getTable('plans')->drop(true);
		$this->db->getTable('positions')->drop(true);
		$this->db->getTable('tags')->drop(true);
		$this->db->getTable('tutor_course_maps')->drop(true);
		$this->db->getTable('tutors')->drop(true);
		$this->db->getTable('users')->drop(true);
	}
}
