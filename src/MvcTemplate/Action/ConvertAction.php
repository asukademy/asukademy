<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace MvcTemplate\Action;

use Muse\Action\AbstractAction;
use Muse\FileOperator\ConvertOperator;

/**
 * ConvertAction
 */
class ConvertAction extends AbstractAction
{
	/**
	 * Execute this action.
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$convertOperator = new ConvertOperator($this->io);

		$convertOperator->copy($this->config['path.src'], $this->config['path.dest'], $this->replace);
	}
}
