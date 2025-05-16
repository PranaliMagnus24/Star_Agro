<?php

namespace App\Http\Controllers\Admin\RoleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserRoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->orderBy('created_at', 'desc');
            return DataTables::eloquent($users)
                ->addIndexColumn()
                ->addColumn('roles', function ($user) {
                    return $user->getRoleNames()
                                ->map(function ($role) {
                                    return '<span class="badge bg-primary mx-1 text-white">' . $role . '</span>';
                                })->implode(' ');
                })
                ->addColumn('action', function ($user) {
                    $editUrl = route('user.edit', $user->id);
                    $deleteUrl = route('user.delete', $user->id);
                    $buttons = '';
                    if (Auth::user()->can('update user')) {
                        $buttons .= '<a href="' . $editUrl . '" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a> ';
                    }
                    if (Auth::user()->can('delete user')) {
                        $buttons .= '<a href="' . $deleteUrl . '" class="btn btn-danger btn-sm delete-confirm"><i class="bi bi-trash3-fill"></i></a>';
                    }
                    return $buttons;
                })
                ->rawColumns(['roles', 'action'])
                ->make(true);
        }

        return view('admin.role_management.user.index');
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
