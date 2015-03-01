<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Form;

use Windwalker\Form\Field\CheckboxField;
use Windwalker\Form\Field\PasswordField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The LoginFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LoginFieldDefinition implements FieldDefinitionInterface
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
		$form->addField(
			new TextField(
				'username',
				'帳號'
			)
		);

		$form->addField(
			new PasswordField(
				'password',
				'密碼'
			)
		);

		$form->addField(new CheckboxField('remember', '記得我'))
			->set('value', 1);
	}
}
