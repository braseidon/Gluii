<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;
use HTML;

class UserPresenter extends Presenter {

	/**
	 * Return the User's full name
	 *
	 * @return string
	 */
	public function name()
	{
		return $this->entity->first_name . ' ' . $this->entity->last_name;
	}

	public function title()
	{
		$user = '<label class="label bg-success m-l-xs">User</label>';
		$mod = '<label class="label bg-info m-l-xs">Editor</label>';
		$admin = '<label class="label bg-primary m-l-xs">Admin</label>';
	}

	public function onlineStatus()
	{
		return $online = '<i class="on b-white"></i>';
		$offline	= '<i class="busy b-white"></i>';
		$away		= '<i class="away b-white"></i>';
	}

	/**
	 * Returns the user Gravatar image url.
	 *
	 * @return string
	 */
	public function gravatar($size = 30)
	{
		$email = md5($this->entity->email);

		return "//www.gravatar.com/avatar/{$email}?s={$size}";
	}

	/**
	 * Show a User's profile photo at a certain size
	 *
	 * @param  integer $size
	 * @param  array $attributes
	 * @return string
	 */
	public function photoThumb($size = 100, $attributes = [])
	{
		$attributes = HTML::attributes($attributes);

		return '<img src="'. $this->gravatar($size) . '" '. $attributes . ' alt="'. $this->name . '" />';
	}
}