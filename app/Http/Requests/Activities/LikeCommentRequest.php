<?php namespace App\Http\Requests\Activities;

use Auth;
use App\Http\Requests\Request;

class LikeCommentRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Check permissions:
        // - Make sure the author_id is friends with the Status's profile_user_id
        // - OR check if the Status's profile_user_id's permissions are free

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
            'activity_id'    => 'required|integer|exists:comments,id'
        ];
    }
}
