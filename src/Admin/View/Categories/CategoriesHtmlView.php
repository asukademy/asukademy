<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Categories;

use Windwalker\Core\View\BladeHtmlView;

/**
 * The CategoriesHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CategoriesHtmlView extends BladeHtmlView
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
		$data->items = $this->model->getItems();
		$data->pagination = $this->model->getPagination();
	}
}
