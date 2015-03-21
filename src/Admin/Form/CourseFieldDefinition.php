<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Asukademy\Form\Field\CategoriesField;
use Asukademy\Form\Field\ItemlistField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Form\Field;
use Windwalker\Html\Option;
use Windwalker\Table\Table;

/**
 * The CourseFieldDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseFieldDefinition implements FieldDefinitionInterface
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
		$form->addField(new Field\TextField('title', '標題'), 'basic')
			->required()
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('subtitle', '子標題'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('alias', '別名'), 'basic')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new ItemlistField('catid', '分類'), 'basic')
			->set('table', Table::CATEGORIES)
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\ListField('state', '狀態'), 'basic')
			->addOption(new Option('開啟', 1))
			->addOption(new Option('關閉', 0))
			->set('class', '')
			->set('labelClass', '')
			->set('default', 1);

		$form->addField(new ItemlistField('tutors', '講師'), 'basic')
			->set('table', Table::TUTORS)
			->set('title_field', 'name')
			->set('multiple', 1)
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextField('ordering', '排序'), 'basic')
			->set('class', '')
			->set('labelClass', '');

		$form->addField(new Field\TextField('id', 'ID'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('readonly', true);

		$form->addField(new Field\TextField('image', '圖片'), 'info')
			->set('class', '')
			->set('labelClass', '')
			->set('default', null);

		$form->addField(new Field\TextareaField('introtext', '摘要'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('fulltext', '全文'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('learned', '可以學到'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('target', '目標對象'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);

		$form->addField(new Field\TextareaField('note', '備註'), 'desc')
			->set('class', '')
			->set('labelClass', '')
			->set('rows', 7)
			->set('default', null);
	}
}
