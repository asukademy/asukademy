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
		$form->addField(new Field\TextField('id', 'ID'))
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('name', '名稱'))
			->required()
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('nick', '匿稱'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('description', '介紹'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('experience', '經歷'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextField('image', '圖片'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);
	}
}
