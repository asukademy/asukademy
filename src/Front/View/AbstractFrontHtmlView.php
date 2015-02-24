<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View;

use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Data\DataSet;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;

/**
 * The AbstactFrontHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractFrontHtmlView extends BladeHtmlView
{
	/**
	 * prepare
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		// Menus
		$mainmenu = new Registry;

		$mainmenu->loadFile($this->package->getDir() . '/Resources/menus/mainmenu.yml', 'yaml');

		$data->mainmenu = new DataSet($mainmenu->toArray());

		// Class
		$route = Ioc::getConfig()->get('uri.route') ? : 'index';

		$data->page_class = 'page-' . implode(' page-', explode('/', $route));
	}
}
