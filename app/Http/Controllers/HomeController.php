<?php namespace App\Http\Controllers;

use Auth;
use App\Repositories\StatusRepositoryInterface;

class HomeController extends BaseController {

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
	public function getIndex(StatusRepositoryInterface $repository)
	{
		if(! Auth::check())
			return view('auth.register');

		$statuses = $repository->allStatuses();

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

	/**
	 * Test sending an email
	 *
	 * @return die()
	 */
	public function getTestEmail()
	{
		$user = new \App\User;
		$code = '32k4j5325';

		$sent = \Mail::send('emails.auth.activate', compact('user', 'code'), function($m) use ($user)
		{
			$m->to('bluejd910@gmail.com')->subject('Activate Your Account');
		});

		dd($sent);
	}

}
