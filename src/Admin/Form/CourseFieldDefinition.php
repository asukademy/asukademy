<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Form\Field;
use Windwalker\Html\Option;

/**
 * The CourseFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseFieldDefinition implements FieldDefinitionInterface
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
			->disabled();

		$form->addField(new Field\TextField('catid', 'Catid'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('title', 'Title'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('alias', 'Alias'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('subtitle', 'Subtitle'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('image', 'Image'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('introtext', 'Introtext'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('fulltext', 'Fulltext'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('position_id', 'Position_id'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('quota', 'Quota'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('less', 'Less'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('learned', 'Learned'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('target', 'Target'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('note', 'Note'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\RadioField('state', 'State'))
			->addOption(new Option('Yes', 1))
			->addOption(new Option('No', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);

		$form->addField(new Field\TextareaField('params', 'Params'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);
	}
}
