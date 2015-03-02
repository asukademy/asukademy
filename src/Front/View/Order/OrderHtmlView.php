<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Order;

use Front\View\AbstractFrontHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Ioc;
use Windwalker\Table\Table;
use Windwalker\Database\Schema\Column;

/**
 * The OrderHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class OrderHtmlView extends AbstractFrontHtmlView
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
		parent::prepareData($data);

		$data->plan = $this->model->getPlan();
		$data->form = $this->model->getForm();
		$data->user = User::get();

		$db = Ioc::getDatabase();

		$db->getTable(Table::STAGES)
			->addColumn(new Column\Primary('id'))
			->addColumn(new Column\Integer('course_id'))
			->addColumn(new Column\Varchar('title'))
			->addColumn(new Column\Varchar('alias'))
			->addColumn(new Column\Text('description'))
			->addColumn(new Column\Varchar('position_id'))
			->addColumn(new Column\Integer('quota', 11, Column::UNSIGNED, Column::ALLOW_NULL))
			->addColumn(new Column\Integer('total', 11, Column::UNSIGNED, Column::NOT_NULL, 0))
			->addColumn(new Column\Integer('less', 11, Column::UNSIGNED, Column::ALLOW_NULL))
			->addColumn(new Column\Tinyint('state', 1))
			->addColumn(new Column\Timestamp('start'))
			->addColumn(new Column\Timestamp('end'))
			->addColumn(new Column\Text('params'))
			->create(true);
	}
}
