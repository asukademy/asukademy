<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Key;
use Windwalker\Table\Table;

/**
 * Migration class, version: 20150402071740
 */
class AddIndexes extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable(Table::CATEGORIES, true)
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->update();

		$this->db->getTable(Table::CLASSES, true)
			->addIndex(Key::TYPE_INDEX, null, ['stage_id'])
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->update();

		$this->db->getTable(Table::COURSES, true)
			->addIndex(Key::TYPE_INDEX, null, ['catid'])
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->update();

		$this->db->getTable(Table::ORDERS, true)
			->addIndex(Key::TYPE_INDEX, null, ['user_id'])
			->addIndex(Key::TYPE_INDEX, null, ['course_id'])
			->addIndex(Key::TYPE_INDEX, null, ['stage_id'])
			->addIndex(Key::TYPE_INDEX, null, ['plan_id'])
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->addIndex(Key::TYPE_INDEX, null, ['payment'])
			->update();

		$this->db->getTable(Table::PLANS, true)
			->addIndex(Key::TYPE_INDEX, null, ['stage_id'])
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->update();

		$this->db->getTable(Table::POSITIONS, true)
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->update();

		$this->db->getTable(Table::STAGES, true)
			->addIndex(Key::TYPE_INDEX, null, ['course_id'])
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->addIndex(Key::TYPE_INDEX, null, ['start'])
			->addIndex(Key::TYPE_INDEX, null, ['end'])
			->addIndex(Key::TYPE_INDEX, 'start_end', ['start', 'end'])
			->update();

		$this->db->getTable(Table::TUTORS, true)
			->addIndex(Key::TYPE_INDEX, null, ['user_id'])
			->update();

		$this->db->getTable(Table::TUTOR_COURSE_MAPS, true)
			->addIndex(Key::TYPE_PRIMARY, null, ['tutor_id', 'course_id'])
			->update();

		$this->db->getTable(Table::TUTOR_STAGE_MAPS, true)
			->addIndex(Key::TYPE_PRIMARY, null, ['tutor_id', 'stage_id'])
			->update();

		$this->db->getTable(Table::USERS, true)
			->addIndex(Key::TYPE_INDEX, null, ['username'])
			->addIndex(Key::TYPE_INDEX, null, ['group'])
			->addIndex(Key::TYPE_INDEX, null, ['state'])
			->addIndex(Key::TYPE_INDEX, null, ['email'])
			->update();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable(Table::CATEGORIES, true)
			->dropIndex(Key::TYPE_INDEX, 'state');

		$this->db->getTable(Table::CLASSES, true)
			->dropIndex(Key::TYPE_INDEX, 'stage_id')
			->dropIndex(Key::TYPE_INDEX, 'state');

		$this->db->getTable(Table::COURSES, true)
			->dropIndex(Key::TYPE_INDEX, 'catid')
			->dropIndex(Key::TYPE_INDEX, 'state');

		$this->db->getTable(Table::ORDERS, true)
			->dropIndex(Key::TYPE_INDEX, 'user_id')
			->dropIndex(Key::TYPE_INDEX, 'course_id')
			->dropIndex(Key::TYPE_INDEX, 'stage_id')
			->dropIndex(Key::TYPE_INDEX, 'plan_id')
			->dropIndex(Key::TYPE_INDEX, 'state')
			->dropIndex(Key::TYPE_INDEX, 'payment');

		$this->db->getTable(Table::PLANS, true)
			->dropIndex(Key::TYPE_INDEX, 'stage_id')
			->dropIndex(Key::TYPE_INDEX, 'state');

		$this->db->getTable(Table::POSITIONS, true)
			->dropIndex(Key::TYPE_INDEX, 'state');

		$this->db->getTable(Table::STAGES, true)
			->dropIndex(Key::TYPE_INDEX, 'course_id')
			->dropIndex(Key::TYPE_INDEX, 'state')
			->dropIndex(Key::TYPE_INDEX, 'start')
			->dropIndex(Key::TYPE_INDEX, 'end')
			->dropIndex(Key::TYPE_INDEX, 'start_end');

		$this->db->getTable(Table::TUTORS, true)
			->dropIndex(Key::TYPE_INDEX, 'user_id')
			->update();

		$this->db->getTable(Table::TUTOR_COURSE_MAPS, true)
			->dropIndex(Key::TYPE_PRIMARY, 'PRIMARY');

		$this->db->getTable(Table::TUTOR_STAGE_MAPS, true)
			->dropIndex(Key::TYPE_PRIMARY, 'PRIMARY');

		$this->db->getTable(Table::USERS, true)
			->dropIndex(Key::TYPE_INDEX, 'username')
			->dropIndex(Key::TYPE_INDEX, 'group')
			->dropIndex(Key::TYPE_INDEX, 'state')
			->dropIndex(Key::TYPE_INDEX, 'email');
	}
}
