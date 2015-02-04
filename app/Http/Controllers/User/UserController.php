<?php namespace App\Http\Controllers\User;

use Auth;
use App\Commands\Status\NewStatusCommand;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
// use App\User;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * User Repository
	 *
	 * @var UserRepository $userRepository
	 */
	protected $userRepository;

	/**
	 * Instantiate the Object
	 *
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getViewUserProfile($userId)
	{
		$user = $this->userRepository->getProfile($userId);

		if(! $user)
			return redirect()->route('home')->withErrors(['User Error' => 'User not found!']);

		return view()->make('user.profile', ['user' => $user]);
	}

	/**
	 * Post a new status
	 *
	 * @return Response
	 */
	public function postNewStatus(\App\Http\Requests\Status\StatusRequest $request)
	{
		$this->dispatch(new NewStatusCommand(
			$request->input('profile_user_id'), // profileUserId
				Auth::user()->id, 					// authorId
				$request->input('status')			// status
			));

		return redirect()->route('user/view', $authorId);
	}

}