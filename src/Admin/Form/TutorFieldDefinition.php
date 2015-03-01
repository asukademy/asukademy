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

/**
 * The TutorFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class TutorFieldDefinition implements FieldDefinitionInterface
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

		$form->addField(new Field\TextField('name', 'Name'))
			->required()
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('nick', 'Nick'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('description', 'Description'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('experience', 'Experience'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextField('image', 'Image'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);
	}
}
