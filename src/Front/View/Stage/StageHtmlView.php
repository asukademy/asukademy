<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Stage;

use Asukademy\Helper\PreviewHelper;
use Front\View\AbstractFrontHtmlView;
use Riki\Asset\Asset;
use Windwalker\Core\Authenticate\User;
use Windwalker\Data\Data;
use Windwalker\DataMapper\RelationDataMapper;
use Windwalker\Ioc;
use Windwalker\Table\Table;
use Windwalker\Uri\Uri;

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

		$this->checkAccess($data);

		// Count price
		$data->item->price_min = PHP_INT_MAX;

		$data->item->all_free = true;

		foreach ($data->plans as $plan)
		{
			// Quota
			$plan->people = $plan->total;
			$plan->attendable = $plan->quota ? $plan->quota > $plan->total : true;

			if (!(int) $plan->price)
			{
				$data->item->has_free = true;

				continue;
			}

			// Price
			if ($data->item->price_max < $plan->price)
			{
				$data->item->price_max = $plan->price;
			}

			if ($data->item->price_min > $plan->price)
			{
				$data->item->price_min = $plan->price;
			}

			$data->item->all_free = false;

			// Time
			$now = new \DateTime;

			if ($plan->start && $plan->end)
			{
				$plan->attendable = ($now >= new \DateTime($plan->start) && $now <= new \DateTime($plan->end));
			}
			elseif ($plan->start)
			{
				$plan->attendable = ($now >= new \DateTime($plan->start));
			}
			elseif ($plan->end)
			{
				$plan->attendable = ($now <= new \DateTime($plan->end));
			}
		}

		// Count hours
		if (count($data->item->classes))
		{
			$data->item->hours = array_sum($data->item->classes->hours);
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

		$this->prepareMeta();
	}

	/**
	 * prepareMeta
	 *
	 * @return  void
	 */
	protected function prepareMeta()
	{
		$config = Ioc::getConfig();

		$config['meta.description'] = $this->data->item->course->introtext;

		$config['og.image'] = $this->data->item->course->image;
	}

	/**
	 * checkAccess
	 *
	 * @param Data $data
	 *
	 * @return  void
	 *
	 * @throws \Exception
	 */
	protected function checkAccess($data)
	{
		// Access
		if ($data->item->state < 1)
		{
			if (User::get()->isAdmin() || PreviewHelper::checkStageToken($data->item))
			{
				$uri = new Uri(\Riki\Uri\Uri::current());
				$uri->setVar(PreviewHelper::getStageToken($data->item->id, $data->item->course_id), 1);

				$msg = [
					'此課程尚未發布，目前是預覽狀態',
					'分享預覽網址: ' . $uri
				];

				Ioc::getApplication()
					->addFlash($msg, 'warning')
					->set('meta.robots', 'noindex, nofollow');
			}
			else
			{
				throw new \Exception('找不到頁面', 404);
			}
		}
	}
}
