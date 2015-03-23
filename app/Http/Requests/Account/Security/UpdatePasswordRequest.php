<?php namespace App\Http\Requests\Account\Security;

use Auth;
use App\Http\Requests\Request;

class UpdatePasswordRequest extends Request
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
            'password'         => 'required',
            'password_confirm' => 'required|same:password',
        ];
    }
}
