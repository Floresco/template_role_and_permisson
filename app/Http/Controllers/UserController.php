<?php

namespace App\Http\Controllers;

use App\Enums\Models;
use App\Enums\Permissions;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Utils\Utils;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize(Utils::namePerm(Permissions::ViewAny, Models::USER));
        return view('user_management.users.index', [
            'title' => trans('messages.users'),
            'users' => User::withoutRole('Super Admin')->get()->all()
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $this->authorize(Utils::namePerm(Permissions::Create, Models::USER));
        $test_name = User::query()->where('name', '=', $request['name'])->first();
        if ($test_name != null) {
            \Session::flash('alerts', ['message' => trans('messages.user_exist'), 'type' => 'danger']);
            return redirect()->route('user_management.users.create')->withInput();
        }

        try {
            \DB::beginTransaction();
            $role = Role::whereId($request->role_id)->first();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'created_at' => Carbon::now()
            ]);
            $user->syncRoles($role);
            \DB::commit();
            return redirect()->route('user_management.users.index');
        } catch (\Throwable $t) {
            \DB::rollBack();
            \Session::flash('alerts', ['message' => trans('messages.save_error'), 'type' => 'danger']);
            return redirect()->route('user_management.users.create')->withInput();
        }

    }

    public function create()
    {
        $this->authorize(Utils::namePerm(Permissions::Create, Models::USER));
        return view('user_management.users.form', [
            'title' => trans('messages.new_user'),
            'roles' => $this->getRoles()
        ]);
    }

    public function getRoles(): array
    {
        return Role::whereNotIn('name', ['Super Admin'])->select(['id', 'name', 'description'])->get()->toArray();
    }

    public function show(User $user)
    {
        $this->authorize(Utils::namePerm(Permissions::View, Models::USER));
        \Session::flash('action', 'view');
        return view('user_management.users.form', [
            'title' => trans('messages.show_user', ['user' => $user->name]),
            'roles' => $this->getRoles(),
            'user' => $user
        ]);

    }

    public function edit(User $user)
    {
        $this->authorize(Utils::namePerm(Permissions::Update, Models::USER));
        \Session::flash('action', 'update');
        return view('user_management.users.form', [
            'title' => trans('messages.edit_user', ['user' => $user->name]),
            'roles' => $this->getRoles(),
            'user' => $user
        ]);

    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $this->authorize(Utils::namePerm(Permissions::Update, Models::USER));
        $test_name = User::query()
            ->where('name', '=', $request['name'])
            ->where('id', '<>', $user->id)
            ->first();
        if ($test_name != null) {
            \Session::flash('alerts', ['message' => trans('messages.user_exist'), 'type' => 'danger']);
            return redirect()->route('user_management.users.edit', ['user' => $user->id])->withInput();
        }

        try {
            \DB::beginTransaction();

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => Carbon::now()
            ];
            if ($request->password !== null) {
                $data['password'] = $request->password;
            }
            $user->update($data);
            if (!in_array($request->role_id, $user->roles()->select('id')->allRelatedIds()->toArray())) {
                $role = Role::whereId($request->role_id)->first();
                $user->syncRoles($role);
            }
            \DB::commit();
            return redirect()->route('user_management.users.index');
        } catch (\Throwable $t) {
            \DB::rollBack();
            \Session::flash('alerts', ['message' => trans('messages.save_error'), 'type' => 'danger']);
            return redirect()->route('user_management.users.create')->withInput();
        }
    }

    public function destroy(User $user)
    {
        $this->authorize(Utils::namePerm(Permissions::Delete, Models::USER));
        return $user->delete();
    }
}
