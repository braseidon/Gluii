<?php namespace App\Http\Controllers\User;

use Auth;
use App\Commands\Status\NewStatusCommand;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getViewUser($userId)
	{
		if(! $user = User::with('statuses')->find($userId))
		{
			return redirect()->route('home')->withErrors(['Jesus', 'You retard']);
		}

		return view()->make('user.profile', ['user' => $user]);
	}

	/**
	 * Post a new status
	 *
	 * @return Response
	 */
	public function postNewStatus(\App\Http\Requests\Status\StatusRequest $request)
	{
		$userId = Auth::user()->id;

		$this->dispatch(new NewStatusCommand($userId, $request->input('status')));

		return redirect()->route('user/view', $userId);
	}

}