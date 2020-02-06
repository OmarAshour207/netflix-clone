<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only('index');
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only('destroy');
    }

    public function index()
    {
        $roles = Role::whereRoleNot('super_admin')->get();
        $users = User::whereRoleNot('super_admin')->
                whenSearch(\request()->search)
                ->whenRole(\request()->role_id)
                ->with('roles')
                ->paginate(5);
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users,email',
            'password'      => 'required|confirmed',
            'role_id'       => 'required|numeric'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());

        $user->attachRoles(['admin', $request->role_id]);

        session()->flash('success', 'Users attached successfully');
        return redirect()->route('dashboard.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users,email,' . $user->id,
            'password'      => 'required|confirmed',
            'role_id'       => 'required|numeric'
        ]);

        $user->update($request->all());
        $user->syncRoles(['admin', $request->role_id]);

        session()->flash('success', 'Users updated successfully');
        return redirect()->route('dashboard.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'Users deleted successfully');
        return redirect()->route('dashboard.users.index');
    }


}
