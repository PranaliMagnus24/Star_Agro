<?php

namespace App\Http\Controllers\Admin\RoleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;


class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::query()->orderBy('created_at', 'desc');
            return DataTables::eloquent($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($role) {
                    $editUrl = route('role.edit', $role->id);
                    $deleteUrl = route('role.delete', $role->id);
                    $permUrl = route('role.permissions', $role->id);
                    $buttons = '<a href="' . $permUrl . '" class="btn btn-primary btn-sm">Add / Edit Role Permission</a> ';
                    if (Auth::user()->can('update role')) {
                        $buttons .= '<a href="' . $editUrl . '" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a> ';
                    }
                    if (Auth::user()->can('delete role')) {
                        $buttons .= '<a href="' . $deleteUrl . '" class="btn btn-danger btn-sm delete-confirm"><i class="bi bi-trash3-fill"></i></a>';
                    }
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.role_management.role.index');
    }

    public function create()
    {
        return view('admin.role_management.role.create');
    }

    public function store(Request $request)
    {
           $request->validate([
            'name' => 'required|string|unique:roles,name',
           ]);

           Role::create([
            'name' => $request->name
           ]);

           return redirect('roles')->with('success','Role created successfully!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role_management.role.edit',compact('role'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|unique:roles,name,' . $id,
    ]);

    $role = Role::findOrFail($id);
    $role->update([
        'name' => $request->name,
    ]);

    return redirect('roles')->with('success', 'Role updated successfully!');
}

public function delete($id)
{
    $role = Role::findOrFail($id);
    $role->delete();
    return redirect('roles')->with('success', 'Role deleted successfully!');
}


public function permissionToRole($id)
{
    $permissions = Permission::all();
    $role = Role::findOrFail($id);
    // $rolePermissions = DB::table('role_has_permissions')
    //                 ->where('role_id', $role->id)
    //                 ->pluck('permission_id')
    //                 ->all();
    $rolePermissions = DB::table('role_has_permissions')
                       ->where('role_has_permissions.role_id', $role->id)
                       ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                       ->all();
    return view('admin.role_management.role.add_permission', compact('role', 'permissions','rolePermissions'));
}

public function updatePermissionToRole(Request $request, $id)
{
    $request->validate([
        'permission' => 'required|array'
    ]);

    $role = Role::findOrFail($id);
    $role->syncPermissions($request->permission);

    return redirect()->back()->with('success', 'Permissions added to role successfully!');
}





}

