<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Sitemap;

use Asukademy\Helper\DateTimeHelper;
use Front\Model\CoursesModel;
use Front\Model\StagesModel;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\RestfulRouter;
use Windwalker\Core\Router\Router;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$coursesModel = new CoursesModel;
		$stagesModel = new StagesModel;
		$now = DateTimeHelper::format('now', DateTimeHelper::FORMAT_YMD);

		$stagesModel['cache.id'] = 'stage.items';

		$courses = $coursesModel->getItems();
		$stages = $stagesModel->getItems();

		$xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

		foreach ($courses as $course)
		{
			$url = $xml->addChild('url');

			$url->addChild('loc', Router::buildHtml('front:course', ['category_alias' => $course->category_alias, 'alias' => $course->alias], RestfulRouter::TYPE_FULL));
			$url->addChild('lastmod', $now);
			$url->addChild('changefreq', 'daily');
			$url->addChild('priority', '1.0');
		}

		foreach ($stages as $stage)
		{
			$url = $xml->addChild('url');

			$url->addChild('loc', Router::buildHtml('front:stage', ['category_alias' => $stage->category_alias, 'course_alias' => $stage->course_alias, 'id' => $stage->id], RestfulRouter::TYPE_FULL));
			$url->addChild('lastmod', $now);
			$url->addChild('changefreq', 'daily');
			$url->addChild('priority', '0.8');
		}

		$this->app->response->setMimeType('text/xml');

		return $xml->asXML();
	}
}
