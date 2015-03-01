<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Asukademy\Form\Field\CategoriesField;
use Asukademy\Form\Field\ItemlistField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Form\Field;
use Windwalker\Html\Option;
use Windwalker\Table\Table;

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
		$form->addField(new Field\TextField('title', 'Title'), 'basic')
			->required()
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('subtitle', 'Subtitle'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('alias', 'Alias'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new ItemlistField('catid', 'Catid'), 'basic')
			->set('table', Table::CATEGORIES)
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\RadioField('state', 'State'), 'basic')
			->addOption(new Option('Yes', 1))
			->addOption(new Option('No', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);

		$form->addField(new ItemlistField('tutors', 'Tutors'), 'basic')
			->set('table', Table::TUTORS)
			->set('title_field', 'name')
			->set('multiple', 1)
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('id', 'Id'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('image', 'Image'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('introtext', 'Introtext'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('fulltext', 'Fulltext'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('learned', 'Learned'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('target', 'Target'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('note', 'Note'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);
	}
}
