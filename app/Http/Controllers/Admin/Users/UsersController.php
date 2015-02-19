<?php namespace App\Http\Controllers\Admin\Users;

use App\Repositories\UserRepositoryInterface;
use Auth;
use Activation;
use Cartalyst\Sentinel\Addons\UniquePasswords\Exceptions\NotUniquePasswordException;

use App\Http\Controllers\Admin\AdminController;

class UsersController extends AdminController {

	/**
	 * The Sentinel Users repository.
	 *
	 * @var \Cartalyst\Sentinel\Users\UserRepositoryInterface
	 */
	protected $users;

	/**
	 * Placeholder for a form Request
	 *
	 * @var Request $request
	 */
	protected $request;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->users = Auth::getUserRepository();

		$this->roles = Auth::getRoleRepository();
	}

	/**
	 * Displays a listing of users.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getIndex(UserRepositoryInterface $repository)
	{
		$users = $repository->listUsers();

		return view()->make('admin.users.index', compact('users'));
	}

	/*
	|-------------------------------------------------------------------------------------------------
	| Create
	|-------------------------------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Shows the form for creating new user.
	 *
	 * @return \Illuminate\View\View
	 */
	public function getCreateUser()
	{
		return $this->showForm('create');
	}

	/**
	 * Handles posting of the form for creating new user.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postCreateUser()
	{
		return $this->processForm('create');
	}

	/*
	|-------------------------------------------------------------------------------------------------
	| Edit
	|-------------------------------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Shows the form for updating user.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function getEditUser($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handles posting of the form for updating user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postEditUser(\App\Http\Requests\Admin\Users\EditUserRequest $request, $id)
	{
		$this->request = $request;

		return $this->processForm('update', $id);
	}

	/*
	|-------------------------------------------------------------------------------------------------
	| Delete
	|-------------------------------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Removes the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		if($this->currentUser->id != $id)
		{
			if($user = $this->users->createModel()->find($id))
			{
				$user->delete();

				return redirect()->route('admin/users/index')->withSuccess(
					trans('users/messages.success.delete')
				);
			}
		}

		return redirect()->route('admin/users/index')->withErrors(
			trans('users/messages.error.delete')
		);
	}

	/*
	|-------------------------------------------------------------------------------------------------
	| Helpers
	|-------------------------------------------------------------------------------------------------
	|
	|
	*/

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		if($id)
		{
			if(! $user = $this->users->createModel()->find($id))
			{
				return redirect()->route('admin/users/index')->withErrors(
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

		return view()->make('admin.users.edit', compact('mode', 'user', 'roles', 'userRoles'));
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
		$request = $this->request;

		if($id)
		{
			$user  = $this->users->createModel()->find($id);
			$input = $this->prepareInput($request->input(), $mode === 'update' ? true : false);
		}
		else
		{
			$input      = $this->prepareInput($request->input(), true);
			$user       = $this->users->create($input);
			$activation = Activation::create($user);

			Activation::complete($user, $activation->code);
		}

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
			if(! empty($toDel)) $user->roles()->detach($toDel);

			// Attach the user roles
			if(! empty($toAdd)) $user->roles()->attach($toAdd);

			return redirect()->route('admin/users')->withSuccess(
				trans("users/messages.success.{$mode}")
			);
		}
		catch (NotUniquePasswordException $e)
		{
			return redirect()->back()->withInput()->withErrors(
				'This password was used before. You must choose a unique password.'
			);
		}

		return redirect()->back()->withErrors();
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
			if(str_contains($key, 'password') && empty($value)) return false;

			return true;
		});
	}

}
