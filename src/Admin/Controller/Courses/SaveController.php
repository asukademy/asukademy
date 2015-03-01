<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Courses;

use Admin\Model\CourseModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		// Reorder
		$catOrdering = $this->input->getVar('ordering');

		$mapper = new DataMapper(Table::COURSES);

		foreach ($catOrdering as $catid => $ordering)
		{

			asort($ordering);

			$i = 1;

			foreach ($ordering as $k => &$v)
			{
				$v = $i;

				$i++;
			}

			foreach ($ordering as $k => $v)
			{
				$data = ['id' => $k, 'ordering' => $v];

				$mapper->updateOne($data, 'id');
			}
		}

		$keys = array_keys($catOrdering);

		$model = new CourseModel;

		foreach ($keys as $key)
		{
			$model->reorder(['catid' => $key]);
		}

		$this->setRedirect(Router::buildHttp('admin:courses'));
	}
}
