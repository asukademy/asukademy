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

/**
 * The ProfileFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfileFieldDefinition implements FieldDefinitionInterface
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
		$form->addField(new Field\HiddenField('id', 'Id'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('name', '姓名'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('username', '帳號'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('email', 'Email'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\PasswordField('password', '密碼'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('autocomplete', 'off');

		$form->addField(new Field\PasswordField('password2', '密碼確認'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('autocomplete', 'off');

		$form->addField(new Field\TextField('nick', '暱稱'), 'data')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('mobile', '手機'), 'data')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('phone', '電話'), 'data')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('address', '地址'), 'data')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('organization', '組織單位'), 'data')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('title', '職稱'), 'data')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);
	}
}
