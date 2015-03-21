<?php namespace App\Http\Requests\Status;

use Auth;
use App\Http\Requests\Request;

class NewStatusRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Check permissions:
        // - Make sure the author_id is friends with profile_user_id
        // - OR check if profile_user_id's permissions are free

        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'profile_user_id'    => 'required|integer|exists:users,id',
            'status'            => 'required|min:3'
        ];
    }
}
