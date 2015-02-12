<?php namespace App\Http\Controllers\Auth;

use Activation;
use Auth;
use Redirect;

use App\Http\Controllers\BaseController;

class ActivationsController extends BaseController {

	/**
	 * Activates the user using the give code.
	 *
	 * @param  string  $id
	 * @param  string  $code
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function activate($id, $code)
	{
		$user = Auth::findById($id);

		if(! Activation::complete($user, $code))
		{
			return Redirect::route('auth/login')->withErrors();
		}

		return Redirect::route('auth/login')->withSuccess(trans('users/messages.success.activate'));
	}

	/**
	 * Reactivate the given user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function reactivate($id)
	{
		$user = Auth::findById($id);

		$activation = Activation::exists($user) ?: Activation::create($user);

		if(Activation::complete($user, $activation->code))
		{
			return Redirect::route('user.edit', $id)->withSuccess(trans('users/messages.success.activate'));
		}

		return Redirect::route('user.edit', $id)->withErrors(trans('users/messages.error.activate'));
	}

	/**
	 * Deactivates the given user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function deactivate($id)
	{
		Activation::remove(
			Auth::findById($id)
		);

		return Redirect::route('user.edit', $id)->withSuccess(trans('users/messages.success.deactivate'));
	}

}
