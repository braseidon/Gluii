<?php namespace App\Http\Controllers\User;

use App\Commands\Status\LikeStatusCommand;
use App\Commands\Status\NewCommentCommand;
use App\Commands\Status\NewStatusCommand;
use App\Http\Controllers\BaseController;
use App\Commands\Status\LikeCommentCommand;
use App\Repositories\StatusRepository;
use Auth;
use Illuminate\Http\Request;

class StatusController extends BaseController
{

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
        parent::__construct();

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
        $this->dispatch(
            new NewStatusCommand(
                intval($request->input('profile_user_id')),
                Auth::getUser()->id,
                $request->input('status')
            )
        );

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
        $this->dispatch(
            new LikeStatusCommand(
                Auth::getUser()->id,
                $request->input('status_id')
            )
        );

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }

    /**
     * Unlike a Status
     *
     * @param  \App\Http\Requests\Status\LikeStatusRequest $request
     * @return Response
     */
    public function postUnlikeStatus(\App\Http\Requests\Status\LikeStatusRequest $request)
    {
        $this->repository->unlikeStatus(Auth::getUser(), $request->input('status_id'));

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
     * Post a new Comment on a Status
     *
     * @return Response
     */
    public function postNewComment(\App\Http\Requests\Status\NewCommentRequest $request)
    {
        $this->dispatch(
            new NewCommentCommand(
                $request->input('status_id'),
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
    public function postLikeComment(\App\Http\Requests\Status\LikeCommentRequest $request)
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
     * @param  \App\Http\Requests\Status\LikeCommentRequest $request
     * @return Response
     */
    public function postUnlikeComment(\App\Http\Requests\Status\LikeCommentRequest $request)
    {
        $this->repository->unlikeComment(Auth::getUser(), $request->input('comment_id'));

        if (! $request->ajax()) {
            return redirect()->back();
        }
    }
}
