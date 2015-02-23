<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Windwalker\Core\Widget\BladeWidget;

/**
 * The FormRenderer class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class FormRenderer
{
	/**
	 * render
	 *
	 * @param array  $fields
	 * @param string $labelCols
	 * @param string $inputCols
	 * @param string $tmpl
	 *
	 * @return string
	 */
	public static function render(array $fields, $labelCols = 'col-md-2', $inputCols = 'col-md-10', $tmpl = 'admin.form.fields')
	{
		return (new BladeWidget($tmpl))->render([
			'fields' => $fields,
			'label_cols' => $labelCols,
			'input_cols' => $inputCols
		]);
	}
}
