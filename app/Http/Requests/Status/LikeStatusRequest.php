<?php namespace App\Http\Requests\Status;

use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\Request;

class LikeStatusRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		// Check permissions:
		// - Make sure the author_id is friends with the Status's profile_user_id
		// - OR check if the Status's profile_user_id's permissions are free

		return $auth->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'status_id'	=> 'required|integer|exists:statuses,id'
		];
	}

}