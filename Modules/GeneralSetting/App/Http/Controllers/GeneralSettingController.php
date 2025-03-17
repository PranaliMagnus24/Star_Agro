<?php

namespace Modules\GeneralSetting\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\GeneralSetting\App\Models\GeneralSetting;
use Str;
use File;

class GeneralSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){

        $data['getRecord'] = GeneralSetting::find(1);

        return view('generalsetting::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('generalsetting::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $save = GeneralSetting::find(1);
        $save->website_name = $request->website_name;
        $save->email = $request->email;
        $save->phone = $request->phone;
        $save->address = $request->address;
        $save->description = $request->description;
        $save->location_url = $request->location_url;
        $save->gst_number = $request->gst_number;


        if(!empty($request->file('favicon_logo')))
        {
            if(!empty($save->favicon_logo) && file_exists('upload/general_setting/' .$save->favicon_logo))
            {
                unlink('upload/general_setting/' .$save->favicon_logo);
            }
            $file = $request->file('favicon_logo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' .$file->getClientOriginalExtension();
            $file->move('upload/general_setting/',$filename);
            $save->favicon_logo = $filename;
        }

        if(!empty($request->file('header_logo')))
        {
            if(!empty($save->header_logo) && file_exists('upload/general_setting/' .$save->header_logo))
            {
                unlink('upload/general_setting/' .$save->header_logo);
            }
            $file = $request->file('header_logo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' .$file->getClientOriginalExtension();
            $file->move('upload/general_setting/',$filename);
            $save->header_logo = $filename;
        }

        if(!empty($request->file('footer_logo')))
        {
            if(!empty($save->footer_logo) && file_exists('upload/general_setting/' .$save->footer_logo))
            {
                unlink('upload/general_setting/' .$save->footer_logo);
            }
            $file = $request->file('footer_logo');
            $randomStr = Str::random(30);
            $filename = $randomStr . '.' .$file->getClientOriginalExtension();
            $file->move('upload/general_setting/',$filename);
            $save->footer_logo = $filename;
        }

        $save->save();
        return redirect()->route('create.generalSetting')->with('success', 'General Settings created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('generalsetting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('generalsetting::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
