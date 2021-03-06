<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Users;

use Windwalker\Core\Controller\Controller;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$view = $this->getView('Users', 'html');
		$model = $this->getModel('Users');

		$model['list.page']     = $page = $this->input->getInt('page', 1);
		$model['list.limit']    = 25;
		$model['list.start']    = ($model['list.page'] - 1) * $model['list.limit'];
		$model['list.search']   = $this->input->getString('q');
		$model['list.ordering'] = 'user.id desc';

		$view->setModel($model);

		return $view->setLayout('default')->render();
	}
}
