<?php

namespace Modules\Members\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Models\State;
use App\Models\ZipCode;
use App\Models\Country;
use App\Models\User;
use App\Models\FarmerDocuments;
use Illuminate\Support\Facades\Auth;
use Str;
use File;
use DB;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('members::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function profile()
    {
        $user = auth()->user();
        $countries = Country::get(["name", "id"]);
        $states = State::get(["name", "id"]);
        $cities = City::where('state_id',$user->state)->get(["name", "id"]);
        return view('members::update_profile', compact('user','countries','states','cities'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone' => 'required|string|digits:10',
        ]);

        $user = auth()->user();

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->phone = $request->input('phone');

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'gender' => 'required|string',
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'town' => 'required|string',
        'dob' => 'nullable|date',
        'pincode' => 'nullable|string|max:10',
        'referral_code' => 'nullable|string|max:255',
        'known_about_us' => 'nullable|string|max:255',
        'farmer_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();
    $user->gender = $request->gender;
    $user->state = $request->state;
    $user->dob = $request->dob;
    $user->district = $request->district;
    $user->pincode = $request->pincode;
    $user->taluka = $request->taluka;
    $user->town = $request->town;
    $user->referral_code = $request->referral_code;
    $user->known_about_us = $request->known_about_us;

    $user->save();
    if ($request->hasFile('farmer_certificate')) {
        $userFolder = public_path('upload/farmer_documents/' . $user->id);
        if (!file_exists($userFolder)) {
            mkdir($userFolder, 0755, true);
        }

        $existingDocument = FarmerDocuments::where('user_id', $user->id)->first();
        if ($existingDocument) {
            $oldFilePath = public_path($existingDocument->file_path);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
            $existingDocument->delete();
        }

        $file = $request->file('farmer_certificate');
        $filename = Str::random(30) . '.' . $file->getClientOriginalExtension();
        $file->move($userFolder, $filename);

        FarmerDocuments::create([
            'user_id' => $user->id,
            'farmer_certificate' => $filename,
        ]);
    }

    return redirect()->back()->with('success', 'Information added successfully.');
}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('members::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('members::edit');
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


    public function fetchState(Request $request)
    {

        $data['states'] = State::where("country_id", $request->country_id)
                                ->get(["name", "id"]);
                                return response()->json($data);
    }


    public function fetchCity(Request $request)
    {

    $data['cities'] = City::where("state_id", $request->state_id)

                                ->get(["name", "id"]);



    return response()->json($data);

    }


    public function getStateCity($pincode)
    {
        $zipData = DB::table('zip_code')->where('pincode', $pincode)->first();
        if ($zipData) {
            return response()->json([
                'taluka' => $zipData->Taluk,
                'RelatedSuboffice' => $zipData->RelatedSuboffice,
                'officename' => $zipData->officename,
            ]);
        } else {
            return response()->json([
                'taluka' => 'Unknown',
                'RelatedSuboffice' => null,
                'officename' => null,
            ]);
        }
    }

}
