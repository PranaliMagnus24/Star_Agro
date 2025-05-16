<?php

namespace App\Http\Controllers\Admin\points;

use App\Http\Controllers\Controller;
use App\Models\PointsSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PointsSettingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $settings= PointsSetting::query()->orderBy('created_at', 'desc');
            return DataTables::eloquent($settings)
                ->addIndexColumn()
               
                ->addColumn('action', function($setting) {
                    return '
                        <div class="d-flex align-items-center nowrap">
                            <a href="'.route('admin.points.edit', $setting->id).'" class="btn btn-primary me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="'.route('admin.points.destroy', $setting->id).'" class="btn btn-danger delete-confirm me-1"><i class="bi bi-trash3-fill"></i></a>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        
        return view('admin.points.index');
    }

    public function create()
{
    return view('admin.points.create');
}


    public function store(Request $request)
    {
        $request->validate([
            'points_per_inquiry' => 'required|integer|min:1',
        ]);

        PointsSetting::create($request->all());
        return redirect()->route('admin.points.index')->with('success', 'Points setting created successfully.');
    }

    public function edit($id)
    {
        $setting = PointsSetting::findOrFail($id);
        return view('admin.points.create', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'points_per_inquiry' => 'required|integer|min:1',
        ]);

        $setting = PointsSetting::findOrFail($id);
        $setting->update($request->all());
        return redirect()->route('admin.points.index')->with('success', 'Points setting updated successfully.');
    }

    public function destroy($id)
    {
        $setting = PointsSetting::findOrFail($id);
        $setting->delete();
        return redirect()->route('admin.points.index')->with('success', 'Points setting deleted successfully.');
    }  
}
