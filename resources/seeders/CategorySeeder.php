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
class CategorySeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$cats = ['資訊學院', '文學院', '設計學院', '藝術學院', '管理學院'];

		foreach ($cats as $k => $title)
		{
			$data['title'] = $title;
			$data['alias'] = $title;
			$data['eng_title'] = 'Course English Title';
			$data['state'] = 1;
			$data['ordering'] = $k + 1;

			$this->command->out('.', false);
			$this->db->getWriter()->insertOne(Table::CATEGORIES, $data);
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
 