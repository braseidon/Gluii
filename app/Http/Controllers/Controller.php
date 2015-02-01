<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	/**
	 * The currently authenticated user
	 *
	 * @var User|null
	 */
	protected $currentUser = false;

	public function __construct()
	{
		// Clockwork //
		// if (App::environment('local'))
		// {
		// 	$this->beforeFilter(function()
		// 	{
		// 		Event::fire('clockwork.controller.start');
		// 	});

		// 	$this->afterFilter(function()
		// 	{
		// 		Event::fire('clockwork.controller.end');
		// 	});
		// }
	}

}