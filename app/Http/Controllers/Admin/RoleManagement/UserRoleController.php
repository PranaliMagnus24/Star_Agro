<?php

namespace App\Http\Controllers\Admin\RoleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.role_management.user.index',compact('users'));
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('admin.role_management.user.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);

        return redirect('users')->with('success', 'User  created successfully!');
    }

    public function edit($id)
    {
        $roles = Role::pluck('name','name')->all();
        $user = User::findOrFail($id);
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('admin.role_management.user.edit', compact('user','roles','userRoles'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|max:20',
        'roles' => 'required'
    ]);

    $user = User::findOrFail($id);
    $data = [
        'name' => $request->name,
        'email' => $request->email,
    ];
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);
    $user->syncRoles($request->roles);

    return redirect('users')->with('success', 'User  updated successfully!');
}

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('users')->with('success', 'User deleted successfully!');
    }
}
