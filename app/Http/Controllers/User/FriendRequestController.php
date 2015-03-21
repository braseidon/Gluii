<?php namespace App\Http\Controllers\User;

use App\Commands\Users\AcceptFriendRequestCommand;
use App\Commands\Users\RemoveFriendRequestCommand;
use App\Commands\Users\SendFriendRequestCommand;
use App\Http\Controllers\BaseController;
use App\User;
use Auth;
use Illuminate\Http\Request;

class FriendRequestController extends BaseController
{

    /**
     * Send a friend request
     *
     * @param  \App\Http\Requests\Users\FriendRequestRequest $request
     * @return Response
     */
    public function postSendFriendRequest(\App\Http\Requests\Users\FriendRequestRequest $request)
    {
        $this->dispatch(new SendFriendRequestCommand(
                Auth::getUser()->id,        // fromId
                $request->input('toId') // toId
            ));

        return redirect()->route('user/view', $request->input('toId'));
    }

    /**
     * Cancel a friend request
     *
     * @param  \App\Http\Requests\Users\FriendRequestRequest $request
     * @return Response
     */
    public function getRemoveFriend(\App\Http\Requests\Users\FriendRequestRequest $request)
    {
        $this->dispatch(new RemoveFriendRequestCommand(
                Auth::getUser()->id,        // fromId
                $request->input('toId') // toId
            ));

        return redirect()->route('user/view', $request->input('toId'));
    }

    /**
     * Accept a friend request
     *
     * @param  \App\Http\Requests\Users\FriendRequestRequest $request
     * @return Response
     */
    public function getAcceptFriendRequest(\App\Http\Requests\Users\FriendRequestRequest $request)
    {
        $this->dispatch(new AcceptFriendRequestCommand(
                $request->input('fromId'),    // fromId
                Auth::getUser()->id            // toId
            ));

        return redirect()->route('user/view', $request->input('fromId'));
    }

    /**
     * Deny a friend request
     *
     * @param  \App\Http\Requests\Users\FriendRequestRequest $request
     * @return Response
     */
    public function getDenyFriendRequest(\App\Http\Requests\Users\FriendRequestRequest $request)
    {
        $this->dispatch(new DenyFriendRequestCommand(
                Auth::getUser()->id,        // fromId
                $request->input('toId') // toId
            ));

        return redirect()->route('user/view', $request->input('toId'));
    }
}
