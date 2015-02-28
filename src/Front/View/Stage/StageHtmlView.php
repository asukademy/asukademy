<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Stage;

use Front\View\AbstractFrontHtmlView;
use Riki\Asset\Asset;
use Windwalker\DataMapper\RelationDataMapper;
use Windwalker\Table\Table;

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

		$data->item->price_min = PHP_INT_MAX;

		foreach ($data->plans as $plan)
		{
			$plan->people = $plan->total;
			$plan->attendable = $plan->quota ? $plan->quota > $plan->total : true;

			if ($data->item->price_max < $plan->origin_price)
			{
				$data->item->price_max = $plan->origin_price;
			}

			if ($data->item->price_min > $plan->price)
			{
				$data->item->price_min = $plan->price;
			}
		}

		// Other stages
		$data->stages = $this->model['course']->getStages($data->item->course_id);

		// Map
		Asset::addScript('http://maps.google.com/maps/api/js?sensor=fals');
		$data->item->position->map = 'https://www.google.com.tw/maps/place/' . urlencode($data->item->position->address);

		// Tutors
		$tutorMapper = new RelationDataMapper('tutor', Table::TUTORS);
		$tutorMapper->addTable('map', Table::TUTOR_STAGE_MAPS, 'tutor.id = map.tutor_id')
			->addTable('stage', Table::STAGES, 'stage.id = map.stage_id');

		$data->tutors = $tutorMapper->find(['stage.id' => $data->item->id]);
	}
}
