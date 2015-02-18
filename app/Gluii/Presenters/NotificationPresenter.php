<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;

class NotificationPresenter extends Presenter {

	/**
	 * Returns Notification image
	 *
	 * @return string|null
	 */
	public function image($size = 30, $attributes = ['class' => 'img-circle'])
	{
		if($this->entity->friend)
		{
			return $this->entity->friend->present()->photoThumb($size, $attributes);
		}

		$attributes = HTML::attributes($attributes);

		return '<img src="/assets/img/a0.jpg" '. $attributes . ' alt="" />';
	}

	/**
	 * Returns the Notification URL
	 *
	 * @return string
	 */
	public function url()
	{
		$type = head(explode('.', $this->entity->notification_type));

		switch($this->entity->notification_type)
		{
			case 'status' or 'comment':
				return route('status/view', $this->entity->notification_route_params->id);
				break;
			default:
				return route('home');
				break;
		}
	}

	/**
	 * Return the Notification's message
	 *
	 * @return string
	 */
	public function message()
	{
		$params = [];

		if($this->entity->friend)
			$params['name'] = $this->entity->friend->present()->name;

		$message = trans('notifications/notifications.' . $this->entity->notification_type, $params);

		if(! $message)
			return 'Notification has no default message!';

		return $message;
	}

	/**
	 * Returns the Notification route parameteres as an array
	 *
	 * @return array
	 */
	public function routeParams()
	{
		return json_decode(json_encode($this->entity->notification_route_params), true);
	}

	/**
	 * Returns the Notification's icon
	 *
	 * @return string
	 */
	public function icon()
	{
		switch($this->entity->notification_type)
		{
			case 'status.like' or 'comment.like':
				return '<i class="icon icon-like"></i>';
				break;
			case 'status.comment':
				return '<i class="icon icon-bubble"></i>';
				break;
			case 'friendrequest.accept':
				return '<i class="icon icon-user-follow"></i>';
				break;
			default:
				return '<i class="icon icon-globe"></i>';
				break;
		}
	}

	/**
	 * Shows the formatted created_at time
	 *
	 * @return string
	 */
	public function timeFormatted()
	{
		return $this->entity->created_at->format('F jS, Y @ g:ia');
	}
}