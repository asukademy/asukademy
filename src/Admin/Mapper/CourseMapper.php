<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Mapper;

use Windwalker\DataMapper\DataMapper;
use Windwalker\Table\Table;

/**
 * The UserMapper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CourseMapper extends DataMapper
{
	/**
	 * Property table.
	 *
	 * @var  string
	 */
	protected $table = Table::COURSES;
}
