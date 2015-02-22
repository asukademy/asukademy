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
class UserSeeder extends AbstractSeeder
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

		$password = new \Windwalker\Crypt\Password;
		$pass = $password->create(1234);

		foreach (range(1, 50) as $i)
		{
			$data['name'] = $faker->name;
			$data['username'] = ($i == 1) ? 'admin' : $faker->username;
			$data['password'] = $pass;
			$data['group'] = ($i == 1) ? 1 : 0;
			$data['email'] = $faker->email;
			$data['nick'] = $faker->firstName;
			$data['mobile'] = $phone = $faker->phoneNumber;
			$data['phone'] = $phone;
			$data['address'] = $faker->address;
			$data['organization'] = $faker->company;
			$data['title'] = $faker->title;
			$data['state'] = $faker->randomElement([1,1,1,0]);
			$data['registered'] = $faker->dateTime->format('Y-m-d H:s:i');
			$data['last_login'] = $faker->dateTime->format('Y-m-d H:s:i');

			$this->command->out('.', false);
			$this->db->getWriter()->insertOne(Table::USERS, $data);
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
 