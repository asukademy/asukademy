<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\DataMapper\DataMapper;

/**
 * The DatabaseSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create('zh_TW');

		$faker->addProvider(new Faker\Provider\zh_TW\Address($faker));
		$faker->addProvider(new Faker\Provider\zh_TW\Company($faker));
		$faker->addProvider(new Faker\Provider\zh_TW\Person($faker));
		$faker->addProvider(new Faker\Provider\zh_TW\PhoneNumber($faker));
		$faker->addProvider(new Faker\Provider\zh_TW\Text($faker));

		$tutors = (new DataMapper('tutors'))->findColumn('id');
		$positions = (new DataMapper('positions'))->findColumn('id');
		$categories = (new DataMapper('categories'))->findAll();

		$courseTimes = [
			// 8 hours
			'PT8H',
			// 2 weeks and 8 hours
			'P14DT8H'
		];

		$date = new DateTime('2015-' . $faker->month . '-' . $faker->dayOfMonth . ' 09:30:00');

		$images = [
			'https://cloud.githubusercontent.com/assets/1639206/5489440/5513a530-8704-11e4-9907-06954ef6b448.jpg',
			'https://cloud.githubusercontent.com/assets/1639206/5488441/d3ac18ca-86f8-11e4-97e2-0df70669c120.jpg',
			'http://asukademy.com/media/img/courses/teaser/joomla-portfolio.png',
			'http://asukademy.com/media/img/courses/teaser/mis.png',
			'http://asukademy.com/media/img/courses/teaser/ror.png',
			'http://asukademy.com/media/img/courses/teaser/swift.png'
		];

		foreach ($categories as $k => $category)
		{
			foreach (range(1, rand(3, 7)) as $i)
			{
				$data = [];
				$data['catid']    = $category->id;
				$data['title']    = $title = $faker->sentence(4);
				$data['alias']    = $title;
				$data['subtitle'] = $faker->sentence(6);
				$data['start']    = $date->format('Y-m-d H:i:s');

				$date->add(new \DateInterval($faker->randomElement($courseTimes)));
				$data['end'] = $date->format('Y-m-d H:i:s');

				$data['image']       = $faker->randomElement($images);
				$data['introtext']   = file_get_contents(__DIR__ . '/fixtures/intro.md');
				$data['fulltext']    = file_get_contents(__DIR__ . '/fixtures/full.md');
				$data['position_id'] = $faker->randomElement($positions);
				$data['quota']       = $faker->numberBetween(20, 30);
				$data['less']        = 5;
				$data['learned']     = $faker->paragraph();
				$data['target']      = $faker->paragraph();
				$data['note']        = $faker->paragraph();
				$data['state']       = 1;

				$this->db->getWriter()->insertOne('courses', $data, 'id');

				foreach ($faker->randomElements($tutors, rand(1, 3)) as $tutor)
				{
					$map = [];
					$map['tutor_id'] = $tutor;
					$map['course_id'] = $data['id'];

					$this->db->getWriter()->insertOne('tutor_course_maps', $map);
				}
			}
		}
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
 