<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Image;

use Joomla\Image\Image;
use Windwalker\Core\Controller\Controller;
use Windwalker\Filesystem\Folder;

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
		$src    = $this->input->getUrl('url');
		$width  = $this->input->get('w', 100);
		$height = $this->input->get('h', 100);

		$src = urldecode($src);

		$temp = new \SplFileInfo(WINDWALKER_CACHE . '/image/temp/' . md5($src));
		$dest = new \SplFileInfo(WINDWALKER_CACHE . '/image/cache/' . md5($src . $width . $height));

		if (is_file($dest->getPathname() . '.jpg'))
		{
			$file = $dest->getPathname()  . '.jpg';

			$this->output($file);

			return true;
		}

		Folder::create($temp->getPath());

		if (substr($src, 0, 4) == 'http')
		{
			$fp = fopen($temp->getPathname(), 'w+');

			$ch = curl_init();
			$options = array(
				CURLOPT_URL            => $src,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_USERAGENT      => "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.163 Safari/535.1",
				CURLOPT_FOLLOWLOCATION => !ini_get('open_basedir') ? true : false,
				CURLOPT_FILE           => $fp,
				CURLOPT_SSL_VERIFYPEER => false
			);
			curl_setopt_array($ch, $options);
			curl_exec($ch);
			$errno  = curl_errno($ch);
			$errmsg = curl_error($ch);
			curl_close($ch);
			fclose($fp);
		}

		Folder::create($dest->getPath());

		$image = new Image;
		$image->loadFile($temp->getPathname());
		$image->cropResize($width, $height, false);
		$image->toFile($dest->getPathname() . '.jpg');

		$file = $dest->getPathname()  . '.jpg';

		$this->output($file);

		return true;
	}

	/**
	 * output
	 *
	 * @param string $file
	 *
	 * @return  void
	 */
	protected function output($file)
	{
		header('Content-Type: image/jpg');
		header('Content-Length: ' . filesize($file));
		readfile($file);

		die;
	}
}
