<?php namespace App\Http\Requests\Status;

use App\Http\Requests\Request;

class StatusRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		// Need to make sure the author_id is friends with the profile_user_id
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
			'profile_user_id'	=> 'required|integer|exists:users,id',
			'status'			=> 'required|min:3'
		];
	}

}