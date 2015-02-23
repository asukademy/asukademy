<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\UserFieldDefinition;
use Admin\Mapper\UserMapper;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\Form\Form;
use Windwalker\Ioc;

/**
 * The UserModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserModel extends DatabaseModel
{
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

			return (new UserMapper)->findOne($pk);
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
		$form = new Form('user');

		$form->defineFormFields(new UserFieldDefinition);

		$session = Ioc::getSession();

		$data = $data ? : $session->get('user.edit.data');

		$data = $data ? : $this->getItem();

		if ($data)
		{
			$data = clone $data;

			unset($data['password']);

			$form->bind($data);
		}

		return $form;
	}
}
