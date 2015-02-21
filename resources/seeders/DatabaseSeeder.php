<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;

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
		$this->execute('UserSeeder');
		$this->execute('CategorySeeder');
		$this->execute('PositionSeeder');
		$this->execute('TutorSeeder');
		$this->execute('CourseSeeder');
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->db->getTable('categories')->truncate();
		$this->db->getTable('classes')->truncate();
		$this->db->getTable('courses')->truncate();
		$this->db->getTable('orders')->truncate();
		$this->db->getTable('plans')->truncate();
		$this->db->getTable('positions')->truncate();
		$this->db->getTable('tags')->truncate();
		$this->db->getTable('tutor_course_maps')->truncate();
		$this->db->getTable('tutors')->truncate();
		$this->db->getTable('users')->truncate();
	}
}
 