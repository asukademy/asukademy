<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;

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
			$data['state'] = 1;
			$data['ordering'] = $k + 1;

			$this->db->getWriter()->insertOne('categories', $data);
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
 