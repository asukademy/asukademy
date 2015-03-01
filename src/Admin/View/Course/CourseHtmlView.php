<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Course;

use Riki\Asset\Asset;
use Riki\Asset\ScriptManager;
use Riki\Uri\Uri;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The CourseHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseHtmlView extends BladeHtmlView
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
		$data->item   = $this->model->getItem();
		$data->form   = $this->model->getForm();
		$data->stages = $this->model['stages']->getItems();

		ScriptManager::chosen('select');
		Asset::addScript(Uri::media(true) . 'riki/js/tabs-state.js');
	}
}
