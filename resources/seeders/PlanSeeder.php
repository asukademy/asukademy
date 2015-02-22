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

		$stages = (new DataMapper(Table::STAGES))->findAll();

		foreach (range(1, rand(1, 3)) as $i)
		{

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
 