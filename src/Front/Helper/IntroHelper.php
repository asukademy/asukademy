<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Helper;

/**
 * The IntroHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class IntroHelper
{
	/**
	 * cutParagraphs
	 *
	 * @param string $text
	 * @param int    $paragraphs
	 *
	 * @return  string
	 */
	public static function cutParagraphs($text, $paragraphs = 3)
	{
		$ps = explode("\n\n", $text);

		if (count($ps) <= 1)
		{
			return $text;
		}

		$ps = array_slice($ps, 0, $paragraphs);

		return implode("\n\n", $ps);
	}
}
