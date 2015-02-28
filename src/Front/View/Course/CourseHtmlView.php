<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Course;

use Front\View\AbstractFrontHtmlView;
use Windwalker\Core\Router\Router;
use Windwalker\DataMapper\DataMapper;
use Windwalker\DataMapper\RelationDataMapper;
use Windwalker\Table\Table;

/**
 * The CourseHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseHtmlView extends AbstractFrontHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @throws \Exception
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$data->item   = $this->model->getItem();

		if ($data->item->isNull())
		{
			throw new \Exception('沒有此課程', 404);
		}

		$data->stages = $this->model->getStages($data->item->id);
		$data->category = (new DataMapper(Table::CATEGORIES))->findOne(['id' => $data->item->catid]);

		foreach ($data->stages as $stage)
		{
			$stage->time = (new \DateTime($stage->start))->format('Y-m-d');
			$stage->people = $stage->total;
			$stage->attendable = $stage->total < $stage->quota;
		}

		// Recommends
		$this->model['courses']->set('list.ordering', 'RAND()');
		$this->model['courses']->set('list.limit', 5);
		$this->model['courses']->set('filter.category_alias', $data->category->alias);
		$data->recommends = $this->model['courses']->getItems();

		foreach ($data->recommends as $item)
		{
			$item->link = Router::buildHtml('front:course', ['alias' => $item->alias, 'category_alias' => $item->category_alias]);
		}

		// Randoms
		$this->model['courses']->reset();
		$this->model['courses']->set('list.ordering', 'RAND()');
		$this->model['courses']->set('list.limit', 7);
		$data->randoms = $this->model['courses']->getItems();

		foreach ($data->randoms as $item)
		{
			$item->link = Router::buildHtml('front:course', ['alias' => $item->alias, 'category_alias' => $item->category_alias]);
		}

		// Tutors
		$tutorMapper = new RelationDataMapper('tutor', Table::TUTORS);
		$tutorMapper->addTable('map', Table::TUTOR_COURSE_MAPS, 'tutor.id = map.tutor_id')
			->addTable('course', Table::COURSES, 'course.id = map.course_id');

		$data->tutors = $tutorMapper->find(['course.id' => $data->item->id]);
	}
}
