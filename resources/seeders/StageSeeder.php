<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The DatabaseSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StageSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create('zh_TW');

		$courses = (new DataMapper(Table::COURSES))->findAll();
		$positions = (new DataMapper(Table::POSITIONS))->findColumn('id');

		$tutors = (new DataMapper(Table::TUTORS))->findColumn('id');

		$courseTimes = [
			// 8 hours
			'PT8H',
			// 2 weeks and 8 hours
			'P14DT8H'
		];

		foreach ($courses as $course)
		{
			foreach (range(1, rand(1, 3)) as $i)
			{
				$data = [];
				// Time offset
				$date   = new DateTime('2015-' . $faker->month . '-' . $faker->dayOfMonth . ' 09:30:00');
				$offset = $faker->randomElement($courseTimes);

				$data['title']       = $course->title . ' - ' . $i;
				$data['course_id']   = $course->id;
				$data['alias']       = $course->id . '-' . $i;
				$data['description'] = $faker->sentence(2);
				$data['position_id'] = $faker->randomElement($positions);
				$data['quota']       = rand(10, 30);
				$data['less']        = 5;
				$data['state']       = 1;
				$data['start']       = $date->format('Y-m-d H:i:s');

				$date->add(new \DateInterval($offset));
				$data['end'] = $date->format('Y-m-d H:i:s');

				$this->command->out('.', false);
				$this->db->getWriter()->insertOne(Table::STAGES, $data, 'id');

				foreach ($faker->randomElements($tutors, rand(1, 3)) as $tutor)
				{
					$map = [];
					$map['tutor_id'] = $tutor;
					$map['stage_id'] = $data['id'];

					$this->command->out('.', false);
					$this->db->getWriter()->insertOne(Table::TUTOR_STAGE_MAPS, $map);
				}
			}
		}

		$this->command->out();
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
	}
}
 