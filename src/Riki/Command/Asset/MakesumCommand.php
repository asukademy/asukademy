<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Riki\Command\Asset;

use Riki\Symlink\Symlink;
use Windwalker\Console\Command\Command;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Environment\ServerHelper;
use Windwalker\Filesystem\Filesystem;
use Windwalker\Filesystem\Folder;

/**
 * The SyncCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class MakesumCommand extends Command
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'makesum';

	/**
	 * Property description.
	 *
	 * @var  string
	 */
	protected $description = 'Make media sum files';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	public function initialise()
	{
	}

	/**
	 * doExecute
	 *
	 * @return  int
	 */
	protected function doExecute()
	{
		Folder::create(WINDWALKER_CACHE . '/riki');

		$sum = md5(uniqid());

		file_put_contents(WINDWALKER_CACHE . '/riki/MD5SUM', $sum);

		$this->out('Create SUM: <info>' . $sum . '</info> at <info>' . WINDWALKER_CACHE . '/riki/MD5SUM</info>');

		return true;
	}
}
