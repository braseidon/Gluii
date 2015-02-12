<?php namespace App\Http\Controllers;

use Auth;
use View;

class BaseController extends Controller {

	/**
	 * The logged in user.
	 *
	 * @var \Cartalyst\Sentinel\Users\UserInterface
	 */
	protected $currentUser;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->beforeFilter('csrf', [ 'on' => 'post' ]);

		// Clockwork //
		if(\App::environment('local'))
		{
			$this->beforeFilter(function()
			{
				\Event::fire('clockwork.controller.start');
			});

			$this->afterFilter(function()
			{
				\Event::fire('clockwork.controller.end');
			});
		}

		$this->currentUser = Auth::getUser();

		View::share([ 'currentUser' => $this->currentUser ]);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if(! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
