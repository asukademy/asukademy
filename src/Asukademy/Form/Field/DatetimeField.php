<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Form\Field;

use Riki\Asset\Asset;
use Riki\Asset\ScriptManager;
use Windwalker\Form\Field\TextField;

/**
 * The DatetimeField class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DatetimeField extends TextField
{
	/**
	 * prepare
	 *
	 * @param array $attrs
	 *
	 * @return  void
	 */
	public function prepare(&$attrs)
	{
		parent::prepare($attrs);
	}

	/**
	 * buildInput
	 *
	 * @param array $attrs
	 *
	 * @return  string
	 */
	public function buildInput($attrs)
	{
		$format = $this->get('format', 'YYYY-MM-DD HH:mm:ss');
		$input =  parent::buildInput($attrs);
		$id = $this->getId();

		ScriptManager::load('calendar', '#' . $id . '-wrapper', $format);

		$html = <<<HTML
<div id="$id-wrapper" class="input-group date">
$input
<span class="input-group-addon">
	<span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
HTML;

		return $html;
	}
}
