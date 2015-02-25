<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Stage;

use Front\View\AbstractFrontHtmlView;

/**
 * The StageHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StageHtmlView extends AbstractFrontHtmlView
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

		$data->item  = $this->model->getItem();
		$data->plans = $this->model->getPlans();

		foreach ($data->plans as $plan)
		{
			$plan->people = count($plan->orders);
			$plan->attendable = $plan->quota > $plan->people;
		}
	}
}
