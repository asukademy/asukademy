<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Form\Field;

use Asukademy\Helper\DateTimeHelper;
use Windwalker\DataMapper\RelationDataMapper;
use Windwalker\Form\Field\ListField;
use Windwalker\Html\Option;
use Windwalker\String\String;
use Windwalker\Table\Table;

/**
 * The PlansField class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PlansField extends ListField
{
	/**
	 * prepareOptions
	 *
	 * @return  array|Option
	 */
	protected function prepareOptions()
	{
		$now = DateTimeHelper::format('now');

		$mapper = new RelationDataMapper('plan', Table::PLANS);

		$mapper->addTable('stage', Table::STAGES, 'stage.id = plan.stage_id')
			->addTable('course', Table::COURSES, 'course.id = stage.course_id');

		$plans = $mapper->find([
			'plan.state >= 1',
			'stage.state >= 1',
			'course.state >= 1',
			'plan.title IS NOT NULL',
			'stage.start > ' . String::quote($now, '"')
		]);

		$options = [];

		foreach ($plans as $plan)
		{
			$options[] = new Option($plan->course_title . ' - ' . $plan->stage_title . ' - ' . $plan->title, $plan->id);
		}

		return $options;
	}
}
