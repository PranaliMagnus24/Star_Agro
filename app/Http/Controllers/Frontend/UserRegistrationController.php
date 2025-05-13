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
use Illuminate\Support\Facades\Auth;
use Str;
use File;

class UserRegistrationController extends Controller
{
    public function mainRegister()
    {
        $roles = Role::whereNotIn('name', ['admin', 'super-admin'])->pluck('name', 'name')->all();
        $countries = Country::get(["name", "id"]);
        return view('frontend.menus.register', compact('countries', 'roles'));
    }

    public function mainStore(Request $request): RedirectResponse
    {

        $request->validate([
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'phone' => ['required','integer','digits:10', 'unique:'.User::class],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name.' '. $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'terms' => $request->terms,
        ]);
        Auth::login($user);

        $user->syncRoles($request->roles);

        return redirect()->route('member.profile')->with('success', 'Registration created succussfully!');
    }

}
