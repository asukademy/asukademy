<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Page;

use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$view  = $this->getView('Page', 'html');
		$model = $this->getModel('Page');

		$paths = (array) $this->input->getVar('paths');

		$view['paths'] = new Data($paths);

		$view->setModel($model);

		$layout = trim(implode('.', $paths), '.') ? : 'index';

		try
		{
			return $view->setLayout($layout)->render();
		}
		catch (\InvalidArgumentException $e)
		{
			throw new \Exception($e->getMessage(), 404, $e);
		}
	}
}
