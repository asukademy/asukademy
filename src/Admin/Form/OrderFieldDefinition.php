<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Asukademy\Form\Field\PlansField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Form\Field;

/**
 * The OrderFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderFieldDefinition implements FieldDefinitionInterface
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
		$form->addField(new Field\TextField('username', 'User'), 'new');

		$form->addField(new PlansField('plan_id', 'Plan'), 'new');

		$form->addField(new Field\TextField('name', '姓名'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('email', 'Email'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('nick', '暱稱'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('mobile', '手機'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('phone', '電話'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('address', '地址'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('organization', '組織單位'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('vat', '統編'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('title', '職稱'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);
	}
}
