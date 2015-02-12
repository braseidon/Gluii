<?php namespace App\Http\Controllers\User;

use App\Commands\Status\LikeStatusCommand;
use App\Commands\Status\NewCommentCommand;
use App\Commands\Status\NewStatusCommand;
use App\Http\Controllers\BaseController;
use App\Commands\Status\LikeCommentCommand;
use App\Repositories\StatusRepository;
use Auth;

use Illuminate\Http\Request;

class StatusController extends BaseController {

	/**
	 * Status Repository
	 *
	 * @var StatusRepository $repository
	 */
	protected $repository;

	/**
	 * Instantiate the Object
	 *
	 * @param StatusRepository $repository
	 */
	public function __construct(StatusRepository $repository)
	{
		$this->repository = $repository;
	}

	/*
	|--------------------------------------------------------------------------
	| Statuses
	|--------------------------------------------------------------------------
	|
	|
	*/

	public function getViewStatus($statusId)
	{

	}

	/**
	 * Post a new status
	 *
	 * @param  \App\Http\Requests\Status\NewStatusRequest $request
	 * @return Response
	 */
	public function postNewStatus(\App\Http\Requests\Status\NewStatusRequest $request)
	{
		$this->dispatch(new NewStatusCommand(
				$request->input('profile_user_id'),		// profile_user_id
				Auth::user()->id,						// author_id
				$request->input('status')				// status
			));

		return redirect()->back();
	}

	/**
	 * Like a Status
	 *
	 * @param  \App\Http\Requests\Status\LikeStatusRequest $request
	 * @return Response
	 */
	public function postLikeStatus(\App\Http\Requests\Status\LikeStatusRequest $request)
	{
		$this->dispatch(new LikeStatusCommand(
				Auth::user()->id,						// userId
				$request->input('status_id')			// statusId
			));

		return redirect()->back();
	}

	/**
	 * Unlike a Status
	 *
	 * @param  \App\Http\Requests\Status\LikeStatusRequest $request
	 * @return Response
	 */
	public function postUnlikeStatus(\App\Http\Requests\Status\LikeStatusRequest $request)
	{
		$this->repository->unlikeStatus(Auth::user(), $request->input('status_id'));

		return redirect()->back();
	}

	/*
	|--------------------------------------------------------------------------
	| Comments
	|--------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Post a new Comment on a Status
	 *
	 * @return Response
	 */
	public function postNewComment(\App\Http\Requests\Status\NewCommentRequest $request)
	{
		$this->dispatch(new NewCommentCommand(
				$request->input('status_id'),	// statusId
				Auth::user()->id,				// userId
				$request->input('body')			// body
			));

		return redirect()->back();
	}

	public function postLikeComment(\App\Http\Requests\Status\LikeCommentRequest $request)
	{
		$this->dispatch(new LikeCommentCommand(
				Auth::user()->id,				// userId
				$request->input('comment_id')	// commentId
			));

		return redirect()->back();
	}

	/**
	 * Unlike a Comment
	 *
	 * @param  \App\Http\Requests\Status\LikeCommentRequest $request
	 * @return Response
	 */
	public function postUnlikeComment(\App\Http\Requests\Status\LikeCommentRequest $request)
	{
		$this->repository->unlikeComment(Auth::user(), $request->input('comment_id'));

		return redirect()->back();
	}
}