<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Error;

use Front\View\Error\ErrorHtmlView;
use Windwalker\Application\Web\Response;
use Windwalker\Ioc;

/**
 * The ErrorHandler class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ErrorHandler extends \Windwalker\Core\Error\ErrorHandler
{
	/**
	 * respond
	 *
	 * @param \Exception $exception
	 *
	 * @return  void
	 */
	protected static function respond($exception)
	{
		$app = Ioc::getApplication();

		$app->set('uri.route', 'error');

		$view = new ErrorHtmlView;

		if ($exception->getCode() == 404)
		{
			$exception = new \Exception('找不到這個頁面', 404, $exception);
		}
		else
		{
			$exception = new \Exception('系統發生問題', 500, $exception);
		}

		$view['exception'] = $exception;

		$body = $view->setLayout(static::$errorTemplate)->render();

		$response = new Response;

		$response->setHeader('Status', $exception->getCode() ? : 500)
			->setBody($body)
			->respond();

		exit();
	}
}
