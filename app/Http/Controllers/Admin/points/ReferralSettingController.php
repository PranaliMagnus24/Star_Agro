<?php

namespace App\Http\Controllers\Admin\points;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralSetting;
use Yajra\DataTables\Facades\DataTables;

class ReferralSettingController extends Controller
{
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $settings= ReferralSetting::query()->orderBy('created_at', 'desc');
            return DataTables::eloquent($settings)
                ->addIndexColumn()
               
                ->addColumn('action', function($setting) {
                    return '
                        <div class="d-flex align-items-center nowrap">
                            <a href="'.route('admin.referral.edit', $setting->id).'" class="btn btn-primary me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="'.route('admin.referral.destroy', $setting->id).'" class="btn btn-danger delete-confirm me-1"><i class="bi bi-trash3-fill"></i></a>
                        </div>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);
            }
        return view('admin.referral.index');
    }

    public function create()
{
    return view('admin.referral.create');
}


    public function store(Request $request)
    {
        $request->validate([
            'referral_points' => 'required|integer|min:1',
        ]);

        ReferralSetting::create($request->all());
        return redirect()->route('admin.referral.index')->with('success', 'Points setting created successfully.');
    }

    public function edit($id)
    {
        $setting = ReferralSetting::findOrFail($id);
        return view('admin.referral.create', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'referral_points' => 'required|integer|min:1',
        ]);

        $setting = ReferralSetting::findOrFail($id);
        $setting->update($request->all());
        return redirect()->route('admin.referral.index')->with('success', 'Points setting updated successfully.');
    }

    public function destroy($id)
    {
        $setting = ReferralSetting::findOrFail($id);
        $setting->delete();
        return redirect()->route('admin.referral.index')->with('success', 'Points setting deleted successfully.');
    }  
}
