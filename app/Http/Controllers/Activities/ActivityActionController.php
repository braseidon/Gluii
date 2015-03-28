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
    | Likes
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
    public function postNewComment(\App\Http\Requests\Activity\NewCommentRequest $request)
    {
        $this->dispatch(
            new NewCommentCommand(
                $request->input('activity_id'),
                Auth::getUser()->id,
                $request->input('body')
            )
        );

        return redirect()->back();
    }

    /**
     * Process liking a Comment
     *
     * @param   $request
     * @return Response
     */
    public function postLikeComment(\App\Http\Requests\Activity\LikeCommentRequest $request)
    {
        $this->dispatch(
            new LikeCommentCommand(
                Auth::getUser()->id,
                $request->input('comment_id')
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
    public function postUnlikeComment(\App\Http\Requests\Activity\LikeCommentRequest $request)
    {
        $this->repository->unlikeComment(Auth::getUser(), $request->input('comment_id'));

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }
}
