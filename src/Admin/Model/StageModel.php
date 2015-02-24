<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\StageFieldDefinition;
use Admin\Mapper\StageMapper;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Data\Data;
use Windwalker\Form\Form;
use Windwalker\Ioc;

/**
 * The StageModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StageModel extends DatabaseModel
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

			return (new StageMapper)->findOne($pk);
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
		$form = new Form('stage');

		$form->defineFormFields(new StageFieldDefinition);

		$session = Ioc::getSession();

		$data = $data ? : $session->get('stage.edit.data' . $this['item.id']);
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