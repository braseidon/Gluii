<?php namespace App\Gluii\Presenters;

use Setup\Presenter;

class UserPresenter extends Presenter {

	/**
	 * Return the User's full name
	 *
	 * @return string
	 */
	public function fullName()
	{
		return $this->entity->first_name . ' ' . $this->entity->last_name;
	}
}