<?php namespace App\Http\Requests\Users;

use Auth;
use App\Http\Requests\Request;

class FriendRequestRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! Auth::check()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fromId'    => 'required_without:toId|integer',
            'toId'        => 'required_without:fromId|integer',
        ];
    }
}
