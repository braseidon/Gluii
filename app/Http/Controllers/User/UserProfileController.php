<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PhotoRepositoryInterface;

use Illuminate\Http\Request;

class UserProfileController extends BaseController {

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
	public function __construct(UserRepositoryInterface $userRepository)
	{
		parent::__construct();

		$this->userRepository = $userRepository;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getViewTimeline($id)
	{
		$user = $this->userRepository->loadUserTimeline($id);
		$statuses = $user->statuses;

		if(! $user)
			return redirect()->route('home')->withErrors(['User Error' => 'User not found!']);

		return view()->make('profile.feed', compact('user', 'statuses'));
	}

	/**
	 * Display a User's photos
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getViewPhotos(PhotoRepositoryInterface $photoRepository, $id)
	{
		$user	= $this->userRepository->loadUserTimeline($id);
		$photos	= $photoRepository->loadUserPhotos($id);

		if(! $photos)
			return redirect()->route('home')->withErrors(['Photo Error' => 'User has no photos!']);

		return view()->make('profile.photos', compact('user', 'photos'));
	}

	public function getViewVideos($id)
	{
		$user	= $this->userRepository->loadUserTimeline($id);

		return view()->make('profile.videos', compact('user', 'photos'));
	}

	public function getViewCalendar($id)
	{
		$user	= $this->userRepository->loadUserTimeline($id);

		return view()->make('profile.calendar', compact('user', 'photos'));
	}

}