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
class PlanSeeder extends AbstractSeeder
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

		$plans = ['一般票', '早鳥票', '學生票'];

		foreach ($stages as $stage)
		{
			$price = $faker->randomElement([8000, 12000, 24000]);

			foreach (range(0, 2) as $i)
			{
				$data = [];

				$data['stage_id']     = $stage->id;
				$data['title']        = $plans[$i];
				$data['price']        = floor($price * (1 - ($i * 0.1)));
				$data['origin_price'] = $price;
				$data['state']        = 1;
				$data['start']        = null;
				$data['end']          = null;
				$data['quota']        = $faker->optional()->numberBetween(10, 30);
				$data['max_one_time'] = 5;

				$this->command->out('.', false);
				$this->db->getWriter()->insertOne(Table::PLANS, $data);
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
 