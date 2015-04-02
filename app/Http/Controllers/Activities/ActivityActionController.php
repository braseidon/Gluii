<?php namespace App\Http\Controllers\Activities;

use App\Commands\Activities\LikeActivityCommand;
use App\Commands\Activities\LikeCommentCommand;
use App\Commands\Activities\NewCommentCommand;
use App\Commands\Activities\UnlikeActivityCommand;
use App\Repositories\ActivityRepositoryInterface;
use Auth;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ActivityActionController extends BaseController
{

    /**
     * The ActivityRepository
     *
     * @var ActivityRepository
     */
    protected $repository;

    /**
     * Instantiate the Object
     *
     * @param ActivityRepositoryInterface $repository
     */
    public function __construct(ActivityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /*
    |--------------------------------------------------------------------------
    | Activity Like / Unlike
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Like a Activity
     *
     * @param  \App\Http\Requests\Activity\LikeActivityRequest $request
     * @return Response
     */
    public function postLikeActivity($activityType, \App\Http\Requests\Activities\LikeActivityRequest $request)
    {
        $this->dispatch(
            new LikeActivityCommand(
                $activityType,
                $request->input('activity_id'),
                Auth::getUser()->id
            )
        );

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }

    /**
     * Unlike a Activity
     *
     * @param  \App\Http\Requests\Activity\LikeActivityRequest $request
     * @return Response
     */
    public function postUnlikeActivity($activityType, \App\Http\Requests\Activities\LikeActivityRequest $request)
    {
        $this->dispatch(
            new UnlikeActivityCommand(
                $activityType,
                $request->input('activity_id'),
                Auth::getUser()->id
            )
        );

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Post a new Comment on a Activity
     *
     * @return Response
     */
    public function postNewComment($activityType, \App\Http\Requests\Activities\NewCommentRequest $request)
    {
        $this->dispatch(
            new NewCommentCommand(
                $activityType,
                $request->input('activity_id'),
                $request->input('body'),
                Auth::getUser()->id
            )
        );

        return redirect()->back();
    }

    /*
    |--------------------------------------------------------------------------
    | Comment Like / Unlike
    |--------------------------------------------------------------------------
    |
    |
    */

    /**
     * Process liking a Comment
     *
     * @param   $request
     * @return Response
     */
    public function postLikeComment($activityType, \App\Http\Requests\Activities\LikeCommentRequest $request)
    {
        $this->dispatch(
            new LikeCommentCommand(
                $activityType,
                $request->input('activity_id'),
                Auth::getUser()->id
            )
        );

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }

    /**
     * Unlike a Comment
     *
     * @param  \App\Http\Requests\Activity\LikeCommentRequest $request
     * @return Response
     */
    public function postUnlikeComment(\App\Http\Requests\Activities\LikeCommentRequest $request)
    {
        $this->repository->unlikeComment(Auth::getUser(), $request->input('activity_id'));

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }
}
