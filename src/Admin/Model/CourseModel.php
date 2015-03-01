<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\CourseFieldDefinition;
use Admin\Mapper\CourseMapper;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Ioc;
use Windwalker\Table\Table;

/**
 * The CourseModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseModel extends AbstractFormModel
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'course';

	/**
	 * getItem
	 *
	 * @param   mixed  $pk
	 *
	 * @return  Data
	 */
	public function getItem($pk = null)
	{
		return $this->fetch('user.item', function() use ($pk)
		{
			$pk = $pk ? : $this['item.id'];

			if (!$pk)
			{
				return new Data;
			}

			$item = (new CourseMapper)->findOne($pk);

			$item->tutors = (new DataMapper(Table::TUTOR_COURSE_MAPS))->findColumn('tutor_id', ['course_id' => $item->id]);

			return $item;
		});
	}

	/**
	 * getForm
	 *
	 * @param array $data
	 *
	 * @return  Form
	 */
	public function getForm($data = array())
	{
		$form = new Form('course');

		$form->defineFormFields(new CourseFieldDefinition);

		$session = Ioc::getSession();

		$data = $data ? : $session->get('course.edit.data' . $this['item.id']);

		$data = $data ? : $this->getItem();

		if ($data)
		{
			$data = clone $data;

			unset($data['password']);

			$form->bind($data);
		}

		return $form;
	}

	/**
	 * getDefaultTable
	 *
	 * @return  string
	 */
	public function getDefaultTable()
	{
		return Table::COURSES;
	}

	/**
	 * getFieldDefinition
	 *
	 * @return  FieldDefinitionInterface
	 */
	protected function getFieldDefinition()
	{
		return new CourseFieldDefinition;
	}
}
