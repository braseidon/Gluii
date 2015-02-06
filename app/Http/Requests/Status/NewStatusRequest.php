<?php namespace App\Http\Requests\Status;

use Illuminate\Contracts\Auth\Guard;

use App\Http\Requests\Request;

class NewStatusRequest extends Request {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Instantiate the Object
	 *
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

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

		if($this->auth->check())
		{
			return true;
		}

		return false;
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