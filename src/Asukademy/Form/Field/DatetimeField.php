<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Form\Field;

use Riki\Asset\Asset;
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
		Asset::addScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js', false);
		Asset::addScript('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/js/bootstrap-datetimepicker.min.js', false);
		Asset::addStyle('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/css/bootstrap-datetimepicker.min.css', false);

		$format = $this->get('format', 'YYYY-MM-DD hh:mm:ss');
		$input =  parent::buildInput($attrs);
		$id = $this->getId();

		$html = <<<HTML
<div id="$id-wrapper" class="input-group date">
$input
<span class="input-group-addon">
	<span class="glyphicon glyphicon-calendar"></span>
</span>
</div>
<script type="text/javascript">
  $(function() {
    $('#$id-wrapper').datetimepicker({
		format: '$format',
		sideBySide: true,
		calendarWeeks: true
    });
  });
</script>
HTML;

		return $html;
	}
}
