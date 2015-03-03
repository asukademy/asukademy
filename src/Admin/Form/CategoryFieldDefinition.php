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
 * The CategoryFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CategoryFieldDefinition implements FieldDefinitionInterface
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

		$form->addField(new Field\TextField('title', '標題'))
			->required()
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('alias', '別名'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('eng_title', '英文標題'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\RadioField('state', '狀態'))
			->addOption(new Option('Yes', 1))
			->addOption(new Option('No', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);

		$form->addField(new Field\TextField('ordering', '排序'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);
	}
}
