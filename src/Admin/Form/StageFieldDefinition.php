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

		$form->addField(new Field\TextField('id', 'Id'))
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('course_id', 'Course_id'))
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('title', 'Title'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

//		$form->addField(new Field\TextField('alias', 'Alias'))
//			->set('class', '')
//			->set('labelClass', '')
//			->set('default', null);

		$form->addField(new Field\TextareaField('description', 'Description'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextField('quota', 'Quota'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\RadioField('state', 'State'))
			->addOption(new Option('Yes', 1))
			->addOption(new Option('No', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);

		$form->addField(new DatetimeField('start', 'Start'))
			->required()
			->set('class', '')
			->set('format', 'YYYY-MM-DD hh:mm')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new DatetimeField('end', 'End'))
			->set('class', '')
			->set('format', 'YYYY-MM-DD hh:mm')
			->set('labelClass', '')
			->set('default', null);

	}
}
