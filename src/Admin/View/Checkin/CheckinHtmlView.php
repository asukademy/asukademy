<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Checkin;

use Riki\Asset\Asset;
use Riki\Uri\Uri;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The CheckinHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CheckinHtmlView extends BladeHtmlView
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
		$data->items  = $this->model->getItems();
		$data->state  = $this->model->getState();
		$data->stage  = $this->model['stage']->getItem();
		$data->course = $this->model['course']->getItem();

		$data->course_id = $data->state['course.id'];
		$data->stage_id  = $data->state['stage.id'];

		Asset::addScript(Uri::media(true) . 'js/admin/invoice.js');
	}
}
