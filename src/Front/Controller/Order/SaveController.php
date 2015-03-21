<?php
/**
 * Part of asukademy project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Order;

use Admin\Helper\OrderHelper;
use Admin\S3\S3Helper;
use Asukademy\Mail\Mailer;
use Asukademy\Session\CSRFToken;
use DateTime;
use Front\Model\OrderModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Authenticate\UserData;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;
use Windwalker\Ioc;
use Windwalker\Table\Table;
use Windwalker\Validator\Rule\EmailValidator;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * Property data.
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Property model.
	 *
	 * @var OrderModel
	 */
	protected $model;

	/**
	 * Property user.
	 *
	 * @var  UserData
	 */
	protected $user;

	/**
	 * Property plan_id.
	 *
	 * @var int
	 */
	protected $plan_id;

	/**
	 * Property plan.
	 *
	 * @var  Data
	 */
	protected $plan;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		CSRFToken::validate();

		$this->data  = $this->input->getVar('user');
		$this->model = new OrderModel;
		$this->user  = User::get();
		$this->plan_id = $this->input->get('plan_id');

		$this->model['item.id'] = $this->plan_id;

		$this->plan  = $this->model->getPlan();
	}

	/**
	 * doExecute
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$data = new Data($this->data);

		$session = Ioc::getSession();

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			$this->validate($data);

			// Fill data
			$data->user_id    = $this->user->id;
			$data->plan_id    = $this->plan->id;
			$data->plan_title = $this->plan->title;
			$data->course_id  = $this->plan->course->id;
			$data->stage_id   = $this->plan->stage->id;
			$data->price      = $this->plan->price;
			$data->created    = (new DateTime('now'))->format('Y-m-d H:i:s');
			$data->state      = $this->plan->require_validate ? OrderHelper::STATE_PENDING : OrderHelper::STATE_WAIT_PAY;

			if (!$this->plan->require_validate && 0 == (int) $this->plan->price)
			{
				$data->state = OrderHelper::STATE_PAID_SUCCESS;
			}

			$this->model->create($data);

			// Save to profile
			if ($this->input->get('save_to_profile'))
			{
				$user = User::get();

				$user->bind($this->data);

				User::save($user);

				$session = Ioc::getSession();

				$session->set('user', User::get($user->id));
			}

			// Upload Attachment
			$upload = $this->input->files->get('upload');

			if ($upload && $upload['size'] > 0)
			{
				if ($upload['size'] > 5000000)
				{
					throw new ValidFailException('請勿大於 5 MB');
				}

				$tmp = WINDWALKER_TEMP . '/upload/' . md5(uniqid()) . '.' . File::getExtension($upload['name']);

				Folder::create(dirname($tmp));

				File::upload($upload['tmp_name'], $tmp);

				$src = new \SplFileInfo($tmp);
				$dest = new \SplFileInfo('order/attachment/' . md5('AsukademyOrder' . $this->model['item.id']) . '.' . File::getExtension($upload['name']));

				if (!S3Helper::put($src, $dest))
				{
					throw new ValidFailException('上傳失敗');
				}

				$url = 'https://asukademy.s3.amazonaws.com/' . $dest->getPathname();

				(new DataMapper(Table::ORDERS))->updateOne(['id' => $this->model['item.id'], 'attachment' => $url]);

				File::delete($src->getPathname());
			}

			// Send mail
			$this->mail($this->model->getItem());
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$session->set('order.create.data', $data);

			$this->setRedirect(Router::buildHttp('front:order', ['plan_id' => $this->plan_id]), $e->getMessage(), 'warning');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$session->set('order.create.data', $data);

			$this->setRedirect(Router::buildHttp('front:order', ['plan_id' => $this->plan_id]), '報名失敗', 'warning');

			return false;
		}

		$trans->commit();

		$session->remove('order.create.data');

		$this->setRedirect(Router::buildHttp('user:order', ['id' => $this->model['item.id']]), '報名成功', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	private function validate($data)
	{
		$user = $data;

		$now = new \DateTime;
		$start = new \DateTime($this->plan->stage->start);

		if ($now > $start)
		{
			throw new ValidFailException('課程已開始', 404);
		}

		// Check attendable
		if ($this->plan->start && $this->plan->end)
		{
			$this->plan->attendable = ($now >= new \DateTime($this->plan->start) && $now <= new \DateTime($this->plan->end));
		}
		elseif ($this->plan->start)
		{
			$this->plan->attendable = ($now >= new \DateTime($this->plan->start));
		}
		elseif ($this->plan->end)
		{
			$this->plan->attendable = ($now <= new \DateTime($this->plan->end));
		}

		if ($this->plan->state < 1)
		{
			$this->plan->attendable = false;
		}

		if (!$this->plan->attendable)
		{
			throw new ValidFailException('本方案目前不可報名');
		}

		if (!$user->name)
		{
			throw new ValidFailException('請輸入姓名');
		}

		if (!$user->email)
		{
			throw new ValidFailException('請輸入 Email 讓我們可以聯絡您');
		}

		$emailValidator = new EmailValidator;

		if (!$emailValidator->validate($user->email))
		{
			throw new ValidFailException('Email 格式不正確');
		}
	}

	/**
	 * mail
	 *
	 * @param Data $data
	 *
	 * @return  void
	 */
	protected function mail($data)
	{
		$config = Ioc::getConfig();

		$user = User::get();

		if ($this->plan->require_validate)
		{
			$subject = '[飛鳥學院] 您的報名正在等待審核 - 課程：' . $this->plan->course->title . ' - ' . $this->plan->stage->title;
			$body = Mailer::render('mail.wait-confirm', ['item' => $data, 'user' => $user]);

			Mailer::quickSend($subject, $config['mail.from'], [$data->email, $user->email], $body);

			$subject = '[飛鳥學院] ' . $data->name . ' 的報名資料需要審核 - 課程：' . $this->plan->course->title . ' - ' . $this->plan->stage->title;
			$body = Mailer::render('mail.wait-confirm-admin', ['item' => $data, 'user' => $user]);

			Mailer::quickSend($subject, $config['mail.from'], $config['mail.admin'], $body);
		}
	}
}
