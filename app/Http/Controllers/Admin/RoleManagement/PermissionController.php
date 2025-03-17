<?php

namespace App\Http\Controllers\Admin\RoleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admin.role_management.permission.index',compact('permissions'));
    }

    public function create()
    {
        return view('admin.role_management.permission.create');
    }

    public function store(Request $request)
    {
           $request->validate([
            'name' => 'required|string|unique:permissions,name',
           ]);

           Permission::create([
            'name' => $request->name
           ]);

           return redirect('permissions')->with('success','Permission created successfully!');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.role_management.permission.edit',compact('permission'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|unique:permissions,name,' . $id,
    ]);

    $permission = Permission::findOrFail($id);
    $permission->update([
        'name' => $request->name,
    ]);

    return redirect('permissions')->with('success', 'Permission updated successfully!');
}

public function delete($id)
{
    $permission = Permission::findOrFail($id);
    $permission->delete();
    return redirect('permissions')->with('success', 'Permission deleted successfully!');
}


}
