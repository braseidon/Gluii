<?php namespace App\Http\Controllers\Auth;

use App\Commands\Auth\RegisterUserCommand;
use App\Http\Controllers\BaseController;
use App\Http\Requests\RegisterRequest;
use App\User;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Input;
use Sentinel;
use Validator;

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Login
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		try
		{
			$input = Input::all();

			$remember = (bool) array_pull($input, 'remember', false);

			$rules = [
				'email'    => 'required|email',
				'password' => 'required',
			];

			$validator = Validator::make($input, $rules);

			if ($validator->fails())
			{
				return redirect()->back()->withInput()->withErrors($validator);
			}

			if ($auth = Sentinel::authenticate($input, $remember))
			{
				return redirect()->intended('account')->withSuccess(
					'Successfully logged in.'
				);
			}

			$errors = 'Invalid login or password.';
		}
		catch (NotActivatedException $e)
		{
			$errors = 'Account is not activated!';

			return redirect()->to('reactivate')->with('user', $e->getUser());
		}
		catch (ThrottlingException $e)
		{
			$delay = $e->getDelay();

			$errors = "Your account is blocked for {$delay} second(s).";
		}

		return redirect()->back()->withInput()->withErrors($errors);
	}

	/*
	|--------------------------------------------------------------------------
	| Logout
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		$this->auth->logout();

		return redirect()->route('auth/login')->with('success', 'You are now logged out.');
	}

	/*
	|--------------------------------------------------------------------------
	| Register
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		// if($this->auth->check())
		// 	return redirect()->route('home');

		return view('auth.register');
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \App\Http\Requests\Auth\RegisterRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(\App\Http\Requests\Auth\RegisterRequest $request)
	{
		$input = $request->input();

		$registerCommand = $this->dispatch(new RegisterUserCommand($input));

		// Command returns false
		if(! $registerCommand)
			return redirect()->to('auth/register')->withInput()->withErrors(
				'Failed to register.'
			);

		// Command returns true
		return redirect()->route('auth/login')->withSuccess(
			'Your accout was successfully created. Please check your email to activate your account.'
		);
	}

	/*
	|--------------------------------------------------------------------------
	| Misc
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		return property_exists($this, 'redirectTo') ? $this->redirectTo : route('home');
	}

}