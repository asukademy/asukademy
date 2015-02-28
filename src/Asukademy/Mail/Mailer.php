<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Asukademy\Mail;

use Windwalker\Ioc;

/**
 * The Mailer class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Mailer
{
	/**
	 * send
	 *
	 * @param \Swift_Message $message
	 *
	 * @return  boolean
	 */
	public static function send(\Swift_Message $message)
	{
		return Ioc::getMailer()->send($message);
	}

	/**
	 * quickSend
	 *
	 * @param string $subject
	 * @param string $body
	 * @param mixed  $from
	 * @param mixed  $to
	 *
	 * @return  bool
	 */
	public static function quickSend($subject, $body, $from, $to)
	{
		$message = static::newMessage()
			->setSubject($subject)
			->setFrom($from)
			->setTo($to)
			->setBody($body, 'text/html');

		return static::send($message);
	}

	/**
	 * newMessage
	 *
	 * @return  \Swift_Message
	 */
	public static function newMessage()
	{
		return \Swift_Message::newInstance();
	}
}
