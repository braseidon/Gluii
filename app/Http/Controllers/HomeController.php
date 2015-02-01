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
	public function getIndex()
	{
		if(Auth::check())
			return view('home');

		return view('auth.register');
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
