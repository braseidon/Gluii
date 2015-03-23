<?php namespace App\Http\Requests\Account\Security;

use Auth;
use App\Http\Requests\Request;

class UpdateEmailRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'email'         => 'required|email|unique:users,email,' . Auth::getUser()->id,
            'email_confirm' => 'required|same:email'
        ];
    }
}
