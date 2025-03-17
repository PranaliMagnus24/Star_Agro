<?php

namespace App\Http\Controllers\Admin\RoleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.role_management.role.index',compact('roles'));
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

