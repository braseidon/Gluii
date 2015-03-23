<?php namespace App\Http\Requests\Account\Settings;

use Auth;
use App\Http\Requests\Request;

class UpdateSettingsRequest extends Request
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
            'username'  => 'alpha|min:4|max:20|unique:users,username,' . Auth::getUser()->id
        ];
    }
}
