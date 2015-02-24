<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Table\Table;

/**
 * The DatabaseSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DatabaseSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		date_default_timezone_set('UTC');

		$this->execute('UserSeeder');
		$this->execute('CategorySeeder');
		$this->execute('PositionSeeder');
		$this->execute('TutorSeeder');
		$this->execute('CourseSeeder');
		$this->execute('StageSeeder');
		$this->execute('PlanSeeder');
		$this->execute('ClassSeeder');
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->db->getTable(Table::CATEGORIES)->truncate();
		$this->db->getTable(Table::CLASSES)->truncate();
		$this->db->getTable(Table::COURSES)->truncate();
		$this->db->getTable(Table::ORDERS)->truncate();
		$this->db->getTable(Table::PLANS)->truncate();
		$this->db->getTable(Table::POSITIONS)->truncate();
		$this->db->getTable(Table::STAGES)->truncate();
		$this->db->getTable(Table::TAGS)->truncate();
		$this->db->getTable(Table::TUTOR_COURSE_MAPS)->truncate();
		$this->db->getTable(Table::TUTORS)->truncate();
		$this->db->getTable(Table::USERS)->truncate();
	}
}
 