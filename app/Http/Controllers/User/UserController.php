<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRepositoryInterface;

use Illuminate\Http\Request;

class UserController extends BaseController {

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
	public function __construct(UserRepositoryInterface $repository)
	{
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
		$user = $this->repository->loadUserProfile($userId);

		if(! $user)
			return redirect()->route('home')->withErrors(['User Error' => 'User not found!']);

		return view()->make('user.profile', compact('user'));
	}

}