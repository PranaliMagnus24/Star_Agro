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
use Modules\Members\App\Models\EnquiryWallet;
use App\Models\ReferralSetting;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\User;
use App\Models\Referral;
use App\Models\FarmerDocument;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;
use URL;
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
        // dd($request->all());

        $request->validate([
            'first_name' => ['required','string'],
            'last_name' => ['required','string'],
            'phone' => ['required','integer','digits:10'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => 'accepted', ],
            [
                 'first_name'=> __('messages.The first name field is required.'),
                'last_name'=>__('messages.The last name field is required.'),
                'email.unique' => __('messages.Email already exists.'),
                'phone.digits' => __('messages.Phone number must be exactly 10 digits.'),
                'phone'=> __('messages.The phone field is required.'),
                'password'=>__('messages.The password field is required.'),
                'terms'=>__('messages.The terms field must be accepted.'),


            ]);

        

         // Check for referral code in request or URL
           // Check for referral code in request or URL
            $referralCode = $request->query('ref') ?? $request->input('referral_code');
            $parentUser = null;

        if ($referralCode) {
            $parentUser = User::where('referral_code', $referralCode)->first();

            // If referral code is entered but invalid, return with error
          if (!$parentUser) {
                return back()->withInput()->withErrors(['referral_code' => 'Please enter a correct referral code.']);
            }
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name.' '. $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'terms' => $request->terms,
            'referral_code' => strtoupper(Str::random(8)),
        ]);
         // Store referral relationship
        Referral::create([
         'referral_code' => $user->referral_code,
            'user_id' => $user->id,
            'parent_user_id' => $parentUser?->id,
        ]);

        $domain=URL::to('/');
        $url=$domain.'referral-registration?ref='. $referralCode ;
        
       // Assign reward points to the parent (if referral is valid)
       if ($parentUser) {
        $reward = ReferralSetting::where('status', 'Active')->latest()->first()->referral_points ?? 20;


        // Add points to parent's EnquiryWallet
        $wallet = EnquiryWallet::where('user_id', $parentUser->id)->first();
        if ($wallet) {
            $wallet->increment('balance', $reward);
        }
    }


        $user->syncRoles($request->roles);
        
       
$roleId = $user->roles->first()?->id ?? 0;

EnquiryWallet::create([
    'wallet_name' => 'My Wallet',
    'balance'     => 200,
    'user_id'     => $user->id,
    'role_id'     => $roleId,
]);
        Auth::login($user);

        $user->syncRoles($request->roles);

        return redirect()->route('member.profile')->with('success', 'Registration created succussfully!');
    }

}