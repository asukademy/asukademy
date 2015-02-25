<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Form;

use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Form\Field;
use Windwalker\Html\Option;
use Windwalker\Validator\Rule\EmailValidator;

/**
 * The RegistrationFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RegistrationFieldDefinition implements FieldDefinitionInterface
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
		$form->addField(new Field\TextField('name', '姓名'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('username', '帳號'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('email', 'Email'))
			->setValidator(new EmailValidator)
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\PasswordField('password', '密碼'))
			->set('class', '')
			->set('labelClass', '')
			->set('autocomplete', 'off');

		$form->addField(new Field\PasswordField('password2', '確認密碼'))
			->set('class', '')
			->set('labelClass', '')
			->set('autocomplete', 'off');
	}
}
