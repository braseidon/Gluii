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
		$user = User::viewProfile()
			->find($userId);

		if(! $user)
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
		$authorId = Auth::user()->id;

		$this->dispatch(new NewStatusCommand(
			$request->input('profile_user_id'), // profileUserId
			$authorId, 							// authorId
			$request->input('status')			// status
			));

		return redirect()->route('user/view', $authorId);
	}

}