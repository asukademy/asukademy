<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

// Start composer
$autoload = __DIR__ . '/../vendor/autoload.php';

if (!is_file($autoload))
{
	exit('Please run `composer install` First.');
}

include_once $autoload;

include_once __DIR__ . '/../etc/define.php';

$app = new Windwalker\Web\DevApplication(\Windwalker\Ioc::factory());

// For dev environment
$allowRemotes = array(
	'127.0.0.1',
	'fe80::1',
	'::1',
);

$allowRemotes = array_merge($allowRemotes, $app->get('system.allow_ips'));

if (isset($_SERVER['HTTP_CLIENT_IP']) || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
	|| !(in_array(@$_SERVER['REMOTE_ADDR'], $allowRemotes)))
{
	header('HTTP/1.0 403 Forbidden');

	exit('Forbidden');
}

define('WINDWALKER_DEBUG', $app->get('system.debug'));

$app->execute();
