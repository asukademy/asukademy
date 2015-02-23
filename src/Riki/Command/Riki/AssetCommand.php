<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Riki\Command\Riki;

use Riki\Command\Riki\Asset\MakesumCommand;
use Riki\Command\Riki\Asset\SyncCommand;
use Windwalker\Console\Command\Command;

/**
 * The AssetCommand class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AssetCommand extends Command
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'asset';

	/**
	 * Property description.
	 *
	 * @var  string
	 */
	protected $description = 'Asset management';

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->addCommand(new SyncCommand);
		$this->addCommand(new MakesumCommand);

		$this->addGlobalOption('d')
			->alias('dir')
			->description('Set migration file directory.');

		$this->addGlobalOption('p')
			->alias('package')
			->description('Package to run migration.');
	}
}
