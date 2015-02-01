<?php namespace App\Http\Controllers\User;

// use App\Http\Requests;
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
	public function getViewUser($id)
	{
		if(! $user = User::find($id))
		{
			return redirect()->route('home')->withErrors(['Jesus', 'You retard']);
		}

		return view()->make('user.profile', ['user' => $user]);
	}

}