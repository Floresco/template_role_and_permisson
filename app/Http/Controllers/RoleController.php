<?php

namespace App\Http\Controllers;

use App\Enums\Models;
use App\Enums\Permissions;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Utils\Utils;

class RoleController extends Controller
{
    public function index()
    {

        $this->authorize(Utils::namePerm(Permissions::ViewAny, Models::Role));
        return view('user_management.roles.index', [
            'title' => trans('messages.roles'),
            'roles' => Role::whereNotIn('name', ['Super Admin'])->get()->all()
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        $this->authorize(Utils::namePerm(Permissions::Create, Models::Role));
        $test_name = Role::query()->where('name', '=', $request['name'])->first();
        if ($test_name != null) {
            \Session::flash('alerts', ['message' => trans('messages.role_exist'), 'type' => 'danger']);
            return redirect()->route('user_management.roles.create')->withInput()->with('choosen_perms', $request['permissions']);
        }
        try {
            \DB::beginTransaction();
            $role = Role::create([
                'name' => $request['name'],
                'description' => $request['description']
            ]);
            $role->syncPermissions($request['permissions']);
            \DB::commit();
            return redirect()->route('user_management.roles.index');
        } catch (\Throwable $t) {
            \DB::rollBack();
            \Session::flash('alerts', ['message' => trans('messages.save_error'), 'type' => 'danger']);
            return redirect()->route('user_management.roles.create')->withInput()->with('choosen_perms', $request['permissions']);
        }

    }

    public function create()
    {
        $this->authorize(Utils::namePerm(Permissions::Create, Models::Role));
        return view('user_management.roles.form', [
            'title' => trans('messages.new_role'),
            'permissions' => $this->getPermissions(),
        ]);
    }

    public function getPermissions(): array
    {
        return Permission::query()->select(['id', 'name', 'description'])->get()->toArray();
    }

    public function show(Role $role)
    {
        $this->authorize(Utils::namePerm(Permissions::View, Models::Role));
        \Session::flash('action', 'view');
        return view('user_management.roles.form', [
            'title' => trans('messages.show_role', ['role' => $role->name]),
            'permissions' => $this->getPermissions(),
            'role' => $role
        ]);
    }

    public function edit(Role $role)
    {
        $this->authorize(Utils::namePerm(Permissions::Update, Models::Role));

        \Session::flash('action', 'update');
        return view('user_management.roles.form', [
            'title' => trans('messages.edit_role', ['role' => $role->name]),
            'permissions' => $this->getPermissions(),
            'role' => $role
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $this->authorize(Utils::namePerm(Permissions::Update, Models::Role));
        $test_name = Role::query()
            ->where('name', '=', $request['name'])
            ->where('id', '<>', $role->id)
            ->first();
        if ($test_name != null) {
            \Session::flash('alerts', ['message' => trans('messages.role_exist'), 'type' => 'danger']);
            return redirect()->route('user_management.roles.edit', ['role' => $role->id])->withInput()->with('choosen_perms', $request['permissions']);
        }
        try {
            \DB::beginTransaction();
            $role->update([
                'name' => $request['name'],
                'description' => $request['description']
            ]);
            $role->syncPermissions($request['permissions']);
            \DB::commit();
            return redirect()->route('user_management.roles.index');
        } catch (\Throwable $t) {
            \DB::rollBack();
            \Session::flash('alerts', ['message' => trans('messages.save_error'), 'type' => 'danger']);
            return redirect()->route('user_management.roles.edit')->withInput()->with('choosen_perms', $request['permissions']);
        }
    }

    public function destroy(Role $role)
    {
        $this->authorize(Utils::namePerm(Permissions::Delete, Models::Role));
        $role->syncPermissions([]);
        return $role->delete();
    }
}
