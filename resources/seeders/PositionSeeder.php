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
class PositionSeeder extends AbstractSeeder
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

		$positions = [
			'CLBC 大安本館',
			'CLBC 大安別館',
			'CLBC 大船艦',
			'CLBC 大安宅宅',
			'五倍紅寶石出礦坑',
		];

		foreach ($positions as $title)
		{
			$data['title'] = $title;
			$data['url'] = $faker->url;
			$data['address'] = $faker->address;
			$data['map'] = 'https://goo.gl/maps/FU9lY';
			$data['image'] = 'http://i.imgur.com/M7xRejY.jpg';
			$data['description'] = $faker->paragraph();
			$data['note'] = $faker->sentence(7);
			$data['state'] = 1;

			$this->command->out('.', false);
			$this->db->getWriter()->insertOne(Table::POSITIONS, $data);
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
 