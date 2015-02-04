<?php namespace App\Http\Controllers\User;

use App\Commands\Status\NewStatusCommand;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\User;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * User Repository
	 *
	 * @var UserRepository $repository
	 */
	protected $repository;

	/**
	 * Instantiate the Object
	 *
	 * @param UserRepository $repository
	 */
	public function __construct(UserRepository $repository)
	{
		// parent::__construct();

		$this->repository = $repository;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getViewUserProfile($userId)
	{
		$user			= $this->repository->getUserById($userId);
		$userProfile	= $this->repository->loadUserProfile($user);

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

		return redirect()->route('user/view', Auth::user()->id);
	}

}