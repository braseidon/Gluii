<?php namespace App\Http\Controllers\Admin\Users;

use Auth;
use Input;
use Redirect;
use Validator;
use App\Http\Controllers\Admin\AdminController;

class RolesController extends AdminController
{

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

        $this->roles = Auth::getRoleRepository();
    }

    /**
     * Displays a listing of roles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roles->createModel()->paginate();

        return view()->make('sentinel.roles.index', compact('roles'));
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

        if ($role && $role->users->count() === 0) {
            $role->delete();

            return redirect()->route('roles.index')->withSuccess(
                trans('roles/messages.success.delete')
            );
        }

        return redirect()->route('roles.index')->withErrors(
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
        if ($id) {
            if (! $role = $this->roles->createModel()->find($id)) {
                return redirect()->route('roles.index')->withErrors(
                    trans('roles/messages.not_found', compact('id'))
                );
            }
        } else {
            $role = $this->roles->createModel();
        }

        return view()->make('sentinel.roles.form', compact('mode', 'role'));
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

        if ($id) {
            $role = $this->roles->createModel()->find($id);

            $rules['slug'] .= ",slug,{$role->slug},slug";

            $messages = $this->validateRole($input, $rules);

            if ($messages->isEmpty()) {
                $role->fill($input)->save();
            }
        } else {
            $messages = $this->validateRole($input, $rules);

            if ($messages->isEmpty()) {
                $role = $this->roles->createModel()->create($input);
            }
        }

        if ($messages->isEmpty()) {
            return redirect()->route('roles.index')->withSuccess(
                trans("roles/messages.success.{$mode}")
            );
        }

        return redirect()->back()->withInput()->withErrors($messages);
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
