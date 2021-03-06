<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Listener;

use Riki\Asset\Asset;
use Riki\Asset\ScriptManager;
use Asukademy\Error\ErrorHandler;
use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Core\Utilities\DateTimeHelper;
use Windwalker\Event\Event;
use Windwalker\Ioc;
use Windwalker\Utilities\Queue\Priority;

/**
 * The AsukademyListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AsukademyListener
{
	/**
	 * onAfterInitialise
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterInitialise(Event $event)
	{
		RendererHelper::addGlobalPath(WINDWALKER_SOURCE . '/Admin/Templates', Priority::BELOW_NORMAL);
		RendererHelper::addGlobalPath(WINDWALKER_SOURCE . '/Front/Templates', Priority::BELOW_NORMAL);

		// Timezone
		DateTimeHelper::setDefaultTimezone('Asia/Taipei');

		// Error
		if (!Ioc::getConfig()->get('system.debug'))
		{
			ErrorHandler::register(true);
		}

		// Script
		ScriptManager::setModule('calendar', function($name, $asset, $selector = '.calendar', $format = 'YYYY-MM-DD HH:mm:ss')
		{
			static $inited = false;
			static $profile = [];

			if (!$inited)
			{
				Asset::addScript('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js', false);
				Asset::addScript('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/js/bootstrap-datetimepicker.min.js', false);
				Asset::addStyle('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.0.0/css/bootstrap-datetimepicker.min.css', false);
			}

			$inited = true;

			$key = sha1($selector . $format);

			if (!empty($profile[$key]))
			{
				return;
			}

			$js = <<<JS
jQuery(document).ready(function()
{
	\$('$selector').datetimepicker(
	{
		format: '$format',
		sideBySide: true,
		calendarWeeks: true
	})
	.on('click', function(ev)
	{
		$(this).find('input').trigger('change');
	});
});
JS;
			Asset::internalScript($js);

			$profile[$key] = true;
		});
	}
}
