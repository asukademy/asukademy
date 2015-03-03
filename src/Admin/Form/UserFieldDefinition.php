<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\PasswordField;
use Windwalker\Form\Field\RadioField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Html\Option;

/**
 * The UserFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserFieldDefinition implements FieldDefinitionInterface
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
		$form->addField(new TextField('id', 'ID'))
			->set('readonly', true);

		$form->addField(new TextField('name', '名稱'))
			->required();

		$form->addField(new TextField('username', '帳號'))
			->required();

		$form->addField(new PasswordField('password', '密碼'));

		$form->addField(new PasswordField('password2', '再次輸入密碼'));

		$form->addField(new TextField('email', 'Email'))
			->required();

		$form->addField(new TextField('nick', '匿稱'));

		$form->addField(new TextField('mobile', '手機'));

		$form->addField(new TextField('phone', '電話'));

		$form->addField(new TextField('address', '地址'));

		$form->addField(new TextField('organization', '組織'));

		$form->addField(new TextField('title', '職稱'));

		$form->addField(new RadioField('group', '權限'))
			->addOption(new Option('一般會員', 0))
			->addOption(new Option('管理員', 1))
			->set('default', 0);

		$form->addField(new RadioField('state', '狀態'))
			->addOption(new Option('Published', 1))
			->addOption(new Option('Closed', 0))
			->set('default', 1);

		$form->addField(new TextField('activation', '驗證碼'));
	}
}
