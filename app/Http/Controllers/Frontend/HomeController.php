<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use App\Models\FarmerDocument;
use Str;
use File;

class HomeController extends Controller
{
    public function mainIndex()
    {
        return view('frontend.menus.home');
    }

    public function mainAbout()
    {
        return view('frontend.menus.about');
    }

    public function mainServices()
    {
        return view('frontend.menus.services');
    }

    public function mainGallery()
    {
        return view('frontend.menus.gallery');
    }

    public function mainBlog()
    {
        return view('frontend.menus.blog');
    }

    public function mainContact()
    {
        return view('frontend.menus.contact');
    }



    public function mainRegister()
    {
        // Exclude 'admin' and 'super-admin' roles
        $roles = Role::whereNotIn('name', ['admin', 'super-admin'])->pluck('name', 'name')->all();

        // Get countries
        $countries = Country::get(["name", "id"]);

        // Return the view with countries and roles
        return view('frontend.menus.register', compact('countries', 'roles'));
    }
    public function mainStore(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','integer','digits:10'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'state' => $request->state,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'town' => $request->town,
            'referral_code' => $request->referral_code,
            'about_us' => $request->about_us,
            'password' => Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);

        return redirect()->back()->with('success', 'Registration created succussfully!');
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

}
