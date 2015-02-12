<?php namespace App\Http\Controllers\Admin\Users;
/**
 * Part of the Sentinel Kickstart application.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Cartalyst PSL License.
 *
 * This source file is subject to the Cartalyst PSL License that is
 * bundled with this package in the license.txt file.
 *
 * @package    Sentinel Kickstart
 * @version    1.0.0
 * @author     Cartalyst LLC
 * @license    Cartalyst PSL
 * @copyright  (c) 2011-2014, Cartalyst LLC
 * @link       http://cartalyst.com
 */

use View;
use Input;
use Sentinel;
use Redirect;
use Validator;
use Activation;
use Cartalyst\Sentinel\Addons\UniquePasswords\Exceptions\NotUniquePasswordException;

class UsersController extends AuthorizedController {

	/**
	 * The Sentinel Users repository.
	 *
	 * @var \Cartalyst\Sentinel\Users\UserRepositoryInterface
	 */
	protected $users;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->users = Sentinel::getUserRepository();

		$this->roles = Sentinel::getRoleRepository();
	}

	/**
	 * Displays a listing of users.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$users = $this->users->createModel()->paginate();

		return View::make('sentinel.users.index', compact('users'));
	}

	/**
	 * Shows the form for creating new user.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handles posting of the form for creating new user.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Shows the form for updating user.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handles posting of the form for updating user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Removes the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		if ($this->currentUser->id != $id)
		{
			if ($user = $this->users->createModel()->find($id))
			{
				$user->delete();

				return Redirect::route('users.index')->withSuccess(
					trans('users/messages.success.delete')
				);
			}
		}

		return Redirect::route('users.index')->withErrors(
			trans('users/messages.error.delete')
		);
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		if ($id)
		{
			if ( ! $user = $this->users->createModel()->find($id))
			{
				return Redirect::route('users.index')->withErrors(
					trans('users/messages.not_found', compact('id'))
				);
			}
		}
		else
		{
			$user = $this->users->createModel();
		}

		// Get the user roles
		$userRoles = $user->roles->lists('name', 'id');

		// Get all the available roles
		$roles = $this->roles->createModel()->all();

		return View::make('sentinel.users.form', compact('mode', 'user', 'roles', 'userRoles'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		$rules = [
			'email'            => 'required|unique:users',
			'password'         => 'sometimes|required',
			'password_confirm' => 'required_with:password|same:password',
		];

		if ($id)
		{
			$user = $this->users->createModel()->find($id);

			$rules['email'] .= ",email,{$user->email},email";

			$input = $this->prepareInput(Input::all(), $mode === 'update' ? true : false);

			$messages = $this->validateUser($input, $rules);

			if ($messages->isEmpty())
			{
				try
				{
					// Update the user
					$this->users->update($user, array_except($input, 'roles'));

					// Get the new user roles
					$roles = array_get($input, 'roles', []);

					// Get the user roles
					$userRoles = $user->roles->lists('id');

					// Prepare the roles to be added and removed
					$toAdd = array_diff($roles, $userRoles);
					$toDel = array_diff($userRoles, $roles);

					// Detach the user roles
					if ( ! empty($toDel)) $user->roles()->detach($toDel);

					// Attach the user roles
					if ( ! empty($toAdd)) $user->roles()->attach($toAdd);
				}
				catch (NotUniquePasswordException $e)
				{
					return Redirect::back()->withInput()->withErrors(
						'This password was used before. You must choose a unique password.'
					);
				}
			}
		}
		else
		{
			$input = $this->prepareInput(Input::all(), true);

			$messages = $this->validateUser($input, $rules);

			if ($messages->isEmpty())
			{
				$user = $this->users->create($input);

				$activation = Activation::create($user);

				Activation::complete($user, $activation->code);
			}
		}

		if ($messages->isEmpty())
		{
			return Redirect::route('users.index')->withSuccess(
				trans("users/messages.success.{$mode}")
			);
		}

		return Redirect::back()->withInput()->withErrors($messages);
	}

	/**
	 * Validates a user.
	 *
	 * @param  array  $data
	 * @param  array  $rules
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function validateUser(array $data, array $rules)
	{
		$validator = Validator::make($data, $rules);

		$validator->passes();

		return $validator->errors();
	}

	/**
	 * Prepares the given data for being stored.
	 *
	 * @param  array  $data
	 * @param  bool  $removePassword
	 * @return mixed
	 */
	protected function prepareInput($data, $removePassword = false)
	{
		// Check if we should remove the password from the
		// submitted data, this is because the password
		// is not required when updating a user.
		return array_where($data, function($key, $value) use ($removePassword)
		{
			if (str_contains($key, 'password') && empty($value)) return false;

			return true;
		});
	}

}
