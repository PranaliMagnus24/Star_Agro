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
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

use App\Models\City;
use Modules\Location\App\Models\District;
use Modules\Location\App\Models\Taluka;
use Modules\Location\App\Models\Village;
use App\Models\State;
use App\Models\ZipCode;
use App\Models\Country;
use App\Models\User;
use App\Models\FarmerDocuments;
use App\Models\Location; 


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
        $states = State::where('country_id',101)->get(["name", "id"]);
        $cities = District::where('state_id',4008)->get(["district_name", "id"]);
        $talukas = Taluka::where('district_id',22)->get(["taluka_name","id"]);
        $villages=Village::where('taluka_id',221)->get(["village_name","id"]);
        $farmerDocument = FarmerDocuments::where('user_id', $user->id)->first(); 
        return view('members::update_profile', compact('user','countries','states','cities','talukas','villages'));
    }



    ////Update profile
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
        $user->email = $request->input('email');
        $user->save();

    return redirect()->to('/profile?tab=profile-edit')->with('success', 'Profile updated successfully.');
    
    }


public function store(Request $request): RedirectResponse
{
        // dd($request->all());
     $request->validate = [
        'gender' => 'required|string',
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'town' => 'required|string',
        'dob' =>[ 'nullable','date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
        'pincode' => 'nullable|string|max:10',
        'referral_code' => 'nullable|string|max:255',
        'known_about_us' => 'nullable|string|max:255',
        'solar_dryer' =>  'required|string|max:255',
        'farmer_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'aadhar_pancard' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'company_logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        'upload_documents' => 'required|string',
        'documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        'company_name' => 'nullable|string|max:255',
        'location.latitude' => 'required|numeric',
        'location.longitude' => 'required|numeric',
        'location.address' => 'required|string|max:255'
      ];
    
    
  
    if (auth()->user()->hasRole('entrepreneur')) {
        $rules['gst_no'] = 'required|string'; 
     }

    
   
  
    // $request->validate($rules);
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
    $user->solar_dryer = $request->solar_dryer;

    $location = Location::where('user_id', $user->id)->first();
    if ($user->hasRole('entrepreneur')) {
    $user->gst_no = $request->gst_no;
}
    if ($location) {
        // Update existing location
        $location->address = $request->location['address'];
        $location->latitude = $request->location['latitude'];
        $location->longitude = $request->location['longitude'];
        $location->save();
    } else {
        // Create new location
        $location = new Location();
        $location->user_id = $user->id; // Ensure user_id is set
        $location->address = $request->location['address'];
        $location->latitude = $request->location['latitude'];
        $location->longitude = $request->location['longitude'];
        $location->save();
    }



    if ($user->hasRole('entrepreneur')) {
        $user->company_name = $request->company_name;
        
    }

    $user->save();
    if (!$user->save()) {
    \Log::error('User save failed');
    return redirect()->back()->with('error', 'Failed to save user info.');
}
    $location = Location::firstOrNew(['user_id' => $user->id]); 
    // $location = Location::firstOrNew(['user_id' => $user->id]);
    $location->address = $request->location['address'];
    $location->latitude = $request->location['latitude'];
    $location->longitude = $request->location['longitude'];
    $location->save();


       $farmerDocument = FarmerDocuments::firstOrNew(['user_id' => $user->id]);

    // Save upload_documents value (just the type string)
    if ($request->filled('upload_documents')) {
        $farmerDocument->upload_documents = $request->upload_documents;
    }

    $farmerDocument->user_id = $user->id;
    $farmerDocument->save();
    // Handle farmer certificate upload
    if ($request->hasFile('farmer_certificate')) {
        if ($farmerDocument) {
            $this->uploadDocument($request->file('farmer_certificate'), $user->id, 'farmer_certificate', $farmerDocument);
        } else {
            $this->uploadDocument($request->file('farmer_certificate'), $user->id, 'farmer_certificate');
        }
    }

    // Handle company logo upload only if user has role 'entrepreneur''
    if ($user->hasRole('entrepreneur') && $request->hasFile('company_logo')) {
        if ($farmerDocument) {
            $this->uploadDocument($request->file('company_logo'), $user->id, 'company_logo', $farmerDocument);
        } else {
            $this->uploadDocument($request->file('company_logo'), $user->id, 'company_logo');
        }
        // $user->upload_documents = $request->upload_documents;
    }

    if ($user->hasRole('trader') && $request->hasFile('aadhar_pancard')) {
        $farmerDocument = FarmerDocuments::where('user_id', $user->id)->first();
        if ($farmerDocument) {
            $this->uploadDocument($request->file('aadhar_pancard'), $user->id, 'aadhar_pancard', $farmerDocument);
        } else {
            $this->uploadDocument($request->file('aadhar_pancard'), $user->id, 'aadhar_pancard');
        }
    }

    // Handle additional documents upload
    if ($request->upload_documents && $request->hasFile('documents')) {
        $documentType = $request->upload_documents;
        if ($farmerDocument) {
            $this->uploadDocument($request->file('documents'), $user->id, $documentType, $farmerDocument);
        } else {
            $this->uploadDocument($request->file('documents'), $user->id, $documentType);
        }
    }
    return redirect()->to('/profile?tab=profile-change-password')->with('success', 'Information updated successfully!');
}

private function uploadDocument($file, $userId, $documentType, $farmerDocument = null)
{
    $user = auth()->user();

    // Determine the folder name based on role
    if ($user->hasRole('entrepreneur')) {
        $baseFolder = 'upload/company_documents/';
    } elseif ($user->hasRole('trader')) {
        $baseFolder = 'upload/trader_documents/';
    } else {
        $baseFolder = 'upload/farmer_documents/';
    }

    $userFolder = public_path($baseFolder . $userId);
    if (!file_exists($userFolder)) {
        mkdir($userFolder, 0755, true);
    }

    $filename = $documentType . '_' . Str::random(30) . '.' . $file->getClientOriginalExtension();
    $file->move($userFolder, $filename);

    if ($farmerDocument) {
        $farmerDocument->file_path = $baseFolder . $userId . '/' . $filename;
        $farmerDocument->document_type = $documentType;
        $farmerDocument->aadhar_pancard = $documentType === 'aadhar_pancard' ? $filename : $farmerDocument->aadhar_pancard;
        $farmerDocument->company_logo = $documentType === 'company_logo' ? $filename : $farmerDocument->company_logo;
        $farmerDocument->farmer_certificate = $documentType === 'farmer_certificate' ? $filename : $farmerDocument->farmer_certificate;
        $farmerDocument->save();
    } else {
        FarmerDocuments::create([
            'user_id' => $userId,
            'file_path' => $baseFolder . $userId . '/' . $filename,
            'document_type' => $documentType,
            'aadhar_pancard' => $documentType === 'aadhar_pancard' ? $filename : null,
            'company_logo' => $documentType === 'company_logo' ? $filename : null,
            'farmer_certificate' => $documentType === 'farmer_certificate' ? $filename : null,
        ]);
    }
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

////selected state and city
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

    //fetch talukas 
    public function fetchTaluka(Request $request)
{
    $data['talukas'] = Taluka::where("district_id", $request->district_id)
                              ->get(["taluka_name", "id"]);
    return response()->json($data);
}

//fetch villages
public function fetchVillage(Request $request)
{
    $data['villages'] = Village::where("taluka_id", $request->taluka_id)
                                ->orderBy("village_name", "asc") 
                                ->get(["id", "village_name"]);

    return response()->json($data);
}


    /////Fetch zip code and taluka
    public function getTalukaTown($pincode)
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

////Change Password & update password
   public function updatePassword(Request $request)
{
    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->to('/profile?tab=change-password')
                         ->withErrors(['current_password' => 'Current password is incorrect.'])
                         ->withInput();
    }

    if ($request->filled('new_password')) {
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->to('/profile?tab=change-password')
                         ->with('success', 'Password updated successfully!');
    }

    return redirect()->to('/profile?tab=change-password')
                     ->with('info', 'No changes made to the password.');
}

}