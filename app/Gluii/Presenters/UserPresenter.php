<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;
use HTML;

class UserPresenter extends Presenter {

	/*
	|--------------------------------------------------------------------------
	| Name / Image / Title - Display
	|--------------------------------------------------------------------------
	|
	|
	*/

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
	 * Return the User's title, if special
	 *
	 * @return string
	 */
	public function title()
	{
		if($this->entity->hasAccess('admin'))
			return ' <label class="label bg-primary m-l-xs">Admin</label>';

		if($this->entity->hasAccess('mod'))
			return ' <label class="label bg-info m-l-xs">Mod</label>';

		return false;

		$user = '<label class="label bg-success m-l-xs">User</label>';
	}

	/**
	 * Return a User's online status
	 *
	 * @return string
	 */
	public function onlineStatus()
	{
		return $online = '<i class="on b-white"></i>';
		$offline	= '<i class="busy b-white"></i>';
		$away		= '<i class="away b-white"></i>';
	}

	/*
	|--------------------------------------------------------------------------
	| Avatar & Stuff
	|--------------------------------------------------------------------------
	|
	|
	*/

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

		if(! $this->entity->profile_photo_id)
		{
			if($this->entity->gender == 'male')
				return '<img src="/images/avatars/male-silhouette.png" '. $attributes . ' alt="'. $this->name . '" />';

			if($this->entity->gender == 'female')
				return '<img src="/images/avatars/female-silhouette.png" '. $attributes . ' alt="'. $this->name . '" />';
		}

		return '<img src="'. $this->gravatar($size) . '" '. $attributes . ' alt="'. $this->name . '" />';
	}

	/*
	|--------------------------------------------------------------------------
	| Other Stuff
	|--------------------------------------------------------------------------
	|
	|
	*/
}