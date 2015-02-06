<?php namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Show the Home Page
	 *
	 * @return Response
	 */
	public function getIndex(\App\Repositories\StatusRepository $repository)
	{
		if(! Auth::check())
			return view('auth.register');

		$statuses = $repository->allStatuses()->get();

		return view('home', compact('statuses'));

	}

	/**
	 * Some page
	 *
	 * @return Response
	 */
	public function getHome()
	{
		return view('home');
	}

}
