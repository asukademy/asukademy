<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Asukademy\Form\Field\DatetimeField;
use Asukademy\Form\Field\ItemlistField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Form\Field;
use Windwalker\Html\Option;
use Windwalker\Table\Table;

/**
 * The StageFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StageFieldDefinition implements FieldDefinitionInterface
{
	/**
	 * Define the form fields.
	 *
	 * @param Form $form The Windwalker form object.
	 *
	 * @return  void
	 */
	public function define(Form $form)
	{

		$form->addField(new Field\TextField('id', 'ID'))
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('course_id', '課程'))
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('title', '標題'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

//		$form->addField(new Field\TextField('alias', 'Alias'))
//			->set('class', '')
//			->set('labelClass', '')
//			->set('default', null);

		$form->addField(new Field\TextareaField('description', '說明'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new ItemlistField('tutors', '講師'), 'basic')
			->set('table', Table::TUTORS)
			->set('title_field', 'name')
			->set('multiple', 1)
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new ItemlistField('position_id', '場地'), 'info')
			->set('table', Table::POSITIONS)
			->set('class', '')
			->set('labelClass', '')
			->set('ordering', 'title')
			->set('default', null);

		$form->addField(new Field\TextField('quota', '人數限制'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('less', '最少人數'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\ListField('state', '狀態'))
			->addOption(new Option('開啟', 1))
			->addOption(new Option('關閉', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);

		$form->addField(new DatetimeField('start', '開始時間'))
			->required()
			->set('class', '')
			->set('format', 'YYYY-MM-DD hh:mm')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new DatetimeField('end', '結束時間'))
			->set('class', '')
			->set('format', 'YYYY-MM-DD hh:mm')
			->set('labelClass', '')
			->set('default', null);

	}
}
