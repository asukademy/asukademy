<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Record;

use Windwalker\Database\Driver\DatabaseDriver;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The UserRecord class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserRecord extends Record
{
	/**
	 * Class init
	 *
	 * @param DatabaseDriver $db
	 */
	public function __construct(DatabaseDriver $db = null)
	{
		parent::__construct(Table::USERS, 'id', $db);
	}
}
