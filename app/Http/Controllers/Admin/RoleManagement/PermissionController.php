<?php

namespace App\Http\Controllers\Admin\RoleManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index( Request $request)
    {
       
                if ($request->ajax()) {
                    $permissions = Permission::query()->orderBy('name', 'asc');
                    return DataTables::eloquent($permissions)
                        ->addIndexColumn()
                        ->editColumn('name', function($permission) {
                            return ucfirst($permission->name);
                        })
                       
                        ->addColumn('action', function($permission) {
                            return '
                                <div class="d-flex align-items-center nowrap">
                                    <a href="'.route('permission.edit', $permission->id).'" class="btn btn-primary me-1"><i class="bi bi-pencil-square"></i></a>
                                    <a href="'.route('permission.delete', $permission->id).'" class="btn btn-danger delete-confirm me-1"><i class="bi bi-trash3-fill"></i></a>
                                </div>
                            ';
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }
        return view('admin.role_management.permission.index');
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
