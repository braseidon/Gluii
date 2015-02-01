<?php namespace App\Gluii\Presenters\Setup\Contracts;

interface PresentableInterface {

	/**
	 * Prepare a new or cached presenter instance
	 *
	 * @return mixed
	 */
	public function present();

}