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
class ClassSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create('zh_TW');

		$stages = (new DataMapper(Table::STAGES))->findAll();

		foreach ($stages as $stage)
		{
			foreach (range(1, rand(4, 12)) as $i)
			{
				$data['stage_id'] = $stage->id;
				$data['title'] = 'Course - ' . $i;
				$data['hours'] = 3;
				$data['intro'] = $faker->sentence(2);
				$data['description'] = $faker->paragraph();
				$data['ordering'] = $i;
				$data['state'] = 1;

				$this->command->out('.', false);
				$this->db->getWriter()->insertOne(Table::CLASSES, $data);
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
 