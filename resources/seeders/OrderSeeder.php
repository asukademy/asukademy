<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The OrderSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderSeeder extends \Windwalker\Core\Seeder\AbstractSeeder
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

		$plans = (new DataMapper(Table::PLANS))->findAll();
		$users = (new DataMapper(Table::USERS))->findAll();

		foreach ($plans as $plan)
		{
			foreach ($faker->randomElements(iterator_to_array($users), rand(1, $plan->quota)) as $user)
			{
				$data['user_id'] = $user->id;
				$data['plan_id'] = $plan->id;
				$data['stage_id'] = $plan->stage_id;
				$data['plan_title'] = $plan->title;
				$data['price'] = $plan->price;
				$data['name'] = $user->name;
				$data['email'] = $user->email;
				$data['nick'] = $user->nick;
				$data['mobile'] = $user->mobile;
				$data['phone'] = $user->phone;
				$data['address'] = $user->address;
				$data['organization'] = $user->organization;
				$data['title'] = $user->title;
				$data['state'] = 2;
				$data['created'] = $faker->dateTime->format('Y-m-d H:s:i');
				$data['payment'] = 'atm';

				$this->command->out('.', false);
				$this->db->getWriter()->insertOne(Table::ORDERS, $data);
			}
		}

		$this->command->out();
	}
}
