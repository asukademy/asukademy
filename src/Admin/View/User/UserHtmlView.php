<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\User;

use Windwalker\Core\View\BladeHtmlView;

/**
 * The UserHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserHtmlView extends BladeHtmlView
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
		$data->item = $this->model->getItem();
		$data->form = $this->model->getForm();
	}
}
