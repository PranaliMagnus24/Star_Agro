<?php

namespace App\Http\Controllers\Admin\points;

use App\Http\Controllers\Controller;
use App\Models\PointsSetting;
use Illuminate\Http\Request;

class PointsSettingController extends Controller
{
    public function index()
    {
        
        $settings = PointsSetting::paginate(10); 
        return view('admin.points.index', compact('settings'));
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
