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
class TutorSeeder extends AbstractSeeder
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

		foreach (range(1, 8) as $i)
		{
			$data['name'] = $faker->name;
			$data['user_id'] = $faker->optional(0.7)->numberBetween(1, 50);
			$data['name'] = $faker->name;
			$data['nick'] = $faker->firstName;
			$data['description'] = $faker->sentence(5);
			$data['experience'] = <<<EXP
飛鳥工作室 創辦人
Joomla 123 書籍 共同作者
飛鳥新樂園藝文誌 站長
AnimApp 動畫社群 共同創辦人
太藝國際傳播有限公司 網路行銷企劃
EXP;

			$data['image'] = 'https://avatars3.githubusercontent.com/u/1639206';

			$this->command->out('.', false);
			$this->db->getWriter()->insertOne(Table::TUTORS, $data);
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
 