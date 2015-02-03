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