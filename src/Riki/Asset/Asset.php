<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Riki\Asset;

use Windwalker\Core\Facade\Facade;

/**
 * The Asset class.
 *
 * @method  static  AssetManager  addStyle()                addStyle($url, $version = null, $attribs = array())
 * @method  static  AssetManager  addScript()               addScript($url, $version = null, $attribs = array())
 * @method  static  AssetManager  internalStyle()           internalStyle($content)
 * @method  static  AssetManager  internalScript()          internalScript($content)
 * @method  static  string        renderStyles()            renderStyles($withInternal = false)
 * @method  static  string        renderScripts()           renderScripts($withInternal = false)
 * @method  static  string        renderInternalStyles()    renderInternalStyles()
 * @method  static  string        renderInternalScripts()   renderInternalScripts()
 *
 * @since  {DEPLOY_VERSION}
 */
class Asset extends Facade
{
	/**
	 * Property key.
	 *
	 * @var  string
	 */
	protected static $key = 'riki.asset';
}
