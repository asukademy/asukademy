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
			->disabled();

		$form->addField(new TextField('name', 'Name'))
			->required();

		$form->addField(new PasswordField('password', 'Password'));

		$form->addField(new PasswordField('password2', 'Password2'));

		$form->addField(new TextField('email', 'Email'))
			->required();

		$form->addField(new TextField('nick', 'Nick Name'));

		$form->addField(new TextField('mobile', 'Mobile'));

		$form->addField(new TextField('phone', 'Phone'));

		$form->addField(new TextField('address', 'Address'));

		$form->addField(new TextField('organization', 'Organization'));

		$form->addField(new TextField('title', 'Title'));

		$form->addField(new RadioField('state', 'State'))
			->addOption(new Option('Published', 1))
			->addOption(new Option('Closed', 0))
			->set('default', 1);

		$form->addField(new TextField('activation', 'Activation'));
	}
}
