<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\View\Profile;

use Front\View\AbstractFrontHtmlView;

/**
 * The ProfileHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfileHtmlView extends AbstractFrontHtmlView
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
		parent::prepareData($data);

		$data->form = $this->model->getForm();
	}
}
