<?php namespace App\Gluii\Presenters;

use App\Gluii\Presenters\Setup\Presenter;

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
}