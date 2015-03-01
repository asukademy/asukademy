<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Page;

use Front\View\AbstractFrontHtmlView;
use Windwalker\Ioc;

/**
 * The PageHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PageHtmlView extends AbstractFrontHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		parent::prepareData($data);

		$method = implode('_', (array) $data->paths) ? : 'index';

		if (is_callable([$this, $method]))
		{
			$this->$method();
		}
	}

	/**
	 * index
	 *
	 * @return  void
	 */
	protected function index()
	{
		$config = Ioc::getConfig();

		$config['meta.description'] = <<<DESC
飛鳥，在日文中意味著「安居之地」，意即這個地方，既能如飛鳥般意氣風發、前程萬里，卻又是一個讓人寧靜定居的故鄉。我們希望飛鳥學院能夠帶領學生們意氣風發的面對人生，在競爭激烈的現代社會中立足，更希望成為員工們的安居之地，專心面對人生的一切挑戰。
DESC;
		$config['og.image'] = 'https://cloud.githubusercontent.com/assets/1639206/4780266/64533a2a-5c60-11e4-9908-628396b5f69d.jpg';
	}

	/**
	 * about
	 *
	 * @return  void
	 */
	protected function about()
	{
		$config = Ioc::getConfig();

		$config['meta.description'] = <<<DESC
飛鳥學院 (Asukademy) 主要專注在現代社會中許多新興行業所缺乏的專業人才。由於傳統教育所提供的知識與技能逐漸不符合高度變化的現代社會需求，
飛鳥學院希望成為正統教育環境以外的一個全新選擇，帶領大家面對瞬息萬變的各類挑戰。
DESC;
		$config['og.image'] = 'https://windspeaker.s3.amazonaws.com/post/asika/2015/03/01/54f3142dd6050.jpg';
	}

	/**
	 * about
	 *
	 * @return  void
	 */
	protected function contact()
	{
		$config = Ioc::getConfig();

		$config['meta.description'] = <<<DESC
對飛鳥學院的課程有興趣的話，歡迎填寫以下諮詢表單，我們會再通知您最新課程消息。或是在 Facebook 上追蹤我們，瞭解我們的最新動態。
DESC;
		$config['og.image'] = 'https://windspeaker.s3.amazonaws.com/post/asika/2015/03/01/54f3142dd6050.jpg';
	}

	/**
	 * about
	 *
	 * @return  void
	 */
	protected function faq()
	{
		$config = Ioc::getConfig();

		$config['og.image'] = 'https://windspeaker.s3.amazonaws.com/post/asika/2015/03/01/54f3142dd6050.jpg';
	}
}
