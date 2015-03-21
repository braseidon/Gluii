<?php namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'first_name'        => 'required|min:2',
            'last_name'            => 'required|min:2',
            'email'                => 'required|email|unique:users,email',
            'password'            => 'required|confirmed|min:6',
            'birthday_month'    => 'required|numeric',//|between:1,12
            'birthday_day'        => 'required|numeric',//|between:1,31
            'birthday_year'        => 'required|numeric',//|between:1905,2015
            'gender'            => 'required|in:male,female',
            'agree_tos'            => 'required',
        ];
    }
}
