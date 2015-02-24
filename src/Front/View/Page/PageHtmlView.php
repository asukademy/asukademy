<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Page;

use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Data\DataSet;
use Windwalker\Registry\Registry;

/**
 * The PageHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PageHtmlView extends BladeHtmlView
{
	/**
	 * prepareData
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
	}
}
