<?php namespace App\Http\Controllers\User;

use App\Commands\Status\NewStatusCommand;
use App\Repositories\StatusRepository;
use Auth;

use App\Http\Controllers\BaseController;
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

    /**
     * View a single Status
     *
     * @param  integer $statusId
     * @return Response
     */
    public function getViewStatus($statusId)
    {
        $status = $this->repository->findStatusById($statusId);

        return view('statuses.view-status', compact('status'));
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
}
