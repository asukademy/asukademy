<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Mail;

use Asukademy\View\Mail\MailHtmlView;
use SendGrid\Email;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Ioc;

/**
 * The Mailer class.
 *
 * @see  https://github.com/sendgrid/sendgrid-php#sendgrid-php
 * 
 * @since  {DEPLOY_VERSION}
 */
class Mailer
{
	/**
	 * send
	 *
	 * @param Email $message
	 *
	 * @see  https://github.com/sendgrid/sendgrid-php#sendgrid-php
	 *
	 * @return  boolean
	 */
	public static function send(Email $message)
	{
		return Ioc::getMailer()->send($message);
	}

	/**
	 * quickSend
	 *
	 * @param string $subject
	 * @param mixed  $from
	 * @param mixed  $to
	 * @param string $body
	 *
	 * @return bool
	 * @see  https://github.com/sendgrid/sendgrid-php#sendgrid-php
	 *
	 */
	public static function quickSend($subject, $from, $to, $body)
	{
		$message = static::newMessage()
			->setSubject($subject)
			->setFrom($from)
			->setFromName('Asukademy 飛鳥學院')
			->setTos((array) $to)
			->setHtml($body);

		return static::send($message);
	}

	/**
	 * newMessage
	 *
	 * @see  https://github.com/sendgrid/sendgrid-php#sendgrid-php
	 *
	 * @return  Email
	 */
	public static function newMessage()
	{
		return new Email;
	}

	/**
	 * render
	 *
	 * @param string $tmpl
	 * @param array  $data
	 * @param string $package
	 *
	 * @return  string
	 */
	public static function render($tmpl, $data = array(), $package = 'asukademy')
	{
		if (is_string($package))
		{
			$package = PackageHelper::getPackage($package);
		}

		$view = new MailHtmlView($data);
		$view->setPackage($package);

		return $view->setLayout($tmpl)->render();
	}
}
