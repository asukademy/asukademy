<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Users;

use Riki\Asset\Asset;
use Riki\Uri\Uri;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The UsersHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UsersHtmlView extends BladeHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$data->items = $this->model->getItems();
	}
}
