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

class RolesController extends AuthorizedController {

	/**
	 * The Sentinel Roles repository.
	 *
	 * @var \Cartalyst\Sentinel\Roles\RoleRepositoryInterface
	 */
	protected $roles;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->roles = Sentinel::getRoleRepository();
	}

	/**
	 * Displays a listing of roles.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$roles = $this->roles->createModel()->paginate();

		return View::make('sentinel.roles.index', compact('roles'));
	}

	/**
	 * Shows the form for creating a new role.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handles posting of the form for creating a new role.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Shows the form for updating a role.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handles posting of the form for updating a role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Removes the specified role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$role = $this->roles->createModel()->find($id);

		if ($role && $role->users->count() === 0)
		{
			$role->delete();

			return Redirect::route('roles.index')->withSuccess(
				trans('roles/messages.success.delete')
			);
		}

		return Redirect::route('roles.index')->withErrors(
			trans('roles/messages.error.delete')
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
			if ( ! $role = $this->roles->createModel()->find($id))
			{
				return Redirect::route('roles.index')->withErrors(
					trans('roles/messages.not_found', compact('id'))
				);
			}
		}
		else
		{
			$role = $this->roles->createModel();
		}

		return View::make('sentinel.roles.form', compact('mode', 'role'));
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
		$input = Input::all();

		$rules = [
			'name' => 'required',
			'slug' => 'required|unique:roles'
		];

		if ($id)
		{
			$role = $this->roles->createModel()->find($id);

			$rules['slug'] .= ",slug,{$role->slug},slug";

			$messages = $this->validateRole($input, $rules);

			if ($messages->isEmpty())
			{
				$role->fill($input)->save();
			}
		}
		else
		{
			$messages = $this->validateRole($input, $rules);

			if ($messages->isEmpty())
			{
				$role = $this->roles->createModel()->create($input);
			}
		}

		if ($messages->isEmpty())
		{
			return Redirect::route('roles.index')->withSuccess(
				trans("roles/messages.success.{$mode}")
			);
		}

		return Redirect::back()->withInput()->withErrors($messages);
	}

	/**
	 * Validates a role.
	 *
	 * @param  array  $data
	 * @param  array  $rules
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function validateRole(array $data, array $rules)
	{
		$validator = Validator::make($data, $rules);

		$validator->passes();

		return $validator->errors();
	}

}
