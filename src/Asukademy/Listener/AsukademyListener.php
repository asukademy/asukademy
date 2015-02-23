<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Listener;

use Windwalker\Core\Renderer\RendererHelper;
use Windwalker\Event\Event;
use Windwalker\Utilities\Queue\Priority;

/**
 * The AsukademyListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AsukademyListener
{
	public function onAfterInitialise(Event $event)
	{
		RendererHelper::addGlobalPath(WINDWALKER_SOURCE . '/Admin/Templates', Priority::BELOW_NORMAL);
		RendererHelper::addGlobalPath(WINDWALKER_SOURCE . '/Front/Templates', Priority::BELOW_NORMAL);
	}
}
