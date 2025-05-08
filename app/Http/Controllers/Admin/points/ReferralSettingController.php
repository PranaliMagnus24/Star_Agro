<?php

namespace App\Http\Controllers\Admin\points;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralSetting;

class ReferralSettingController extends Controller
{
    public function index()
    {
        
        $settings = ReferralSetting::paginate(10); 
        return view('admin.referral.index', compact('settings'));
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
