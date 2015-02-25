<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Model;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The ActivationModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ActivationModel extends DatabaseModel
{
	/**
	 * activate
	 *
	 * @param string $token
	 *
	 * @return  true
	 *
	 * @throws ValidFailException
	 * @throws \Exception
	 */
	public function activate($token)
	{
		if (!$token)
		{
			throw new \InvalidArgumentException('沒有驗證碼');
		}

		$user = (new DataMapper(Table::USERS))->findOne(['activation' => $token]);

		if ($user->isNull())
		{
			throw new ValidFailException('沒有這個待驗證的使用者');
		}

		$user->activation = '';
		$user->state = 1;

		User::save($user);

		return true;
	}
}
