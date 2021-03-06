<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Record;

use Admin\Mapper\UserMapper;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Database\Driver\DatabaseDriver;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Record\Record;
use Windwalker\Table\Table;

/**
 * The UserRecord class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class StageRecord extends Record
{
	/**
	 * Class init
	 *
	 * @param DatabaseDriver $db
	 */
	public function __construct(DatabaseDriver $db = null)
	{
		parent::__construct(Table::STAGES, 'id', $db);
	}

	/**
	 * delete
	 *
	 * @param int $pKey
	 *
	 * @return  $this
	 */
	public function delete($pKey = null)
	{
		$result = parent::delete($pKey);

		if ($result)
		{
			(new DataMapper(Table::PLANS))->delete(['stage_id' => $this->id]);
			(new DataMapper(Table::CLASSES))->delete(['stage_id' => $this->id]);
			(new DataMapper(Table::TUTOR_STAGE_MAPS))->delete(['stage_id' => $this->id]);
		}
	}

	/**
	 * check
	 *
	 * @return static
	 * @throws ValidFailException
	 */
	public function check()
	{
		return parent::check();
	}

	/**
	 * checkFieldExists
	 *
	 * @param string $field
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	protected function checkFieldExists($field)
	{
		$mapper = new UserMapper;

		$data = $mapper->findOne([$field => $this->$field]);

		if ($data->notNull() && $data->id != $this->id)
		{
			throw new ValidFailException($field . ' exists');
		}
	}
}
