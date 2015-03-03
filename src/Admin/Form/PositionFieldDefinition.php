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
 * The PositionFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PositionFieldDefinition implements FieldDefinitionInterface
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

		$form->addField(new Field\TextField('url', '網站'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('address', '地址'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

//		$form->addField(new Field\TextField('map', '地圖url'))
//			->set('class', '')
//			->set('labelClass', '')
//			->set('default', null);

		$form->addField(new Field\TextField('image', '圖片'))
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('description', '說明'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('note', '備註'))
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\RadioField('state', '狀態'))
			->addOption(new Option('Yes', 1))
			->addOption(new Option('No', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);
	}
}
