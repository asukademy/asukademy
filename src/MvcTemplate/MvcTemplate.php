<?php
/**
 * Part of muse project.
 *
 * @copyright  Copyright (C) 2011 - 2015 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace MvcTemplate;

use Muse\IO\IOInterface;
use Muse\Template\AbstractTemplate;
use Windwalker\Registry\Registry;

/**
 * Template main entry.
 */
class MvcTemplate extends AbstractTemplate
{
	/**
	 * Using {@...@} to prevent twig conflict.
	 *
	 * @var  array
	 */
	protected $tagVariable = array('{@', '@}');

	/**
	 * Register replace string.
	 *
	 * @param IOInterface $io      The IO adapter.
	 * @param array       $replace Replace string array.
	 *
	 * @throws \RuntimeException
	 * @return  array
	 */
	protected function registerReplaces($io, $replace = array())
	{
		$item = $io->getArgument(3, 'sakura');
		$package = $io->getArgument(2, 'flower');

		/*
		 * Replace with your code name.
		 */

		// Set item name, default is sakura
		$replace['package.lower'] = strtolower($package);
		$replace['package.upper'] = strtoupper($package);
		$replace['package.cap']   = ucfirst($package);
		$replace['item.lower'] = strtolower($item);
		$replace['item.upper'] = strtoupper($item);
		$replace['item.cap']   = ucfirst($item);

		// Set project name
		$replace['project.class'] = 'Asukademy';

		return $replace;
	}

	/**
	 * Register config and path.
	 *
	 * @param IOInterface    $io     The IO adapter.
	 * @param array|Registry $config Config object or array.
	 *
	 * @return  array
	 */
	protected function registerConfig($io, $config)
	{
		/*
		 * Replace with your project path.
		 */

		$subTemplate = $io->getOption('t', 'default');
		$dest        = $io->getArgument(1) ? : 'generated';

		$config['path.src']  = __DIR__ . '/Template/' . $subTemplate;
		$config['path.dest'] = GENERATOR_PATH . '/' . $dest;

		if (!is_dir($config['path.dest']))
		{
			throw new \RuntimeException($config['path.dest'] . ' is not a dir.');
		}

		return $config;
	}
}
