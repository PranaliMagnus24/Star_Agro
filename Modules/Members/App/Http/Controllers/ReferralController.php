<?php

namespace Modules\Members\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\Referral;
use App\Models\ReferralSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReferralController extends Controller
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
    public function create()
    {
        return view('members::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
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
    public function referralDetails()
{
    
    $user = auth()->user();
    $referralLink = route('home.register', ['ref' => $user->referral_code]);

    // Fetch all referrals for the logged-in user (users who signed up with their referral code)
    // $referrals = Referral::where('referral_code', $user->referral_code)->get();
    $referrals = Referral::where('parent_user_id', $user->id)->get();



    $totalReferrals = $referrals->count();
    $userDetails = User::whereIn('id', $referrals->pluck('user_id'))->get();

    // Fetch referral points from referral_settings
    $referralPointsSetting = \DB::table('referral_settings')->first(); 
    $pointsPerReferral = $referralPointsSetting->referral_points ?? 0;

    // Calculate total referral points
    $totalReferralPoints = $totalReferrals * $pointsPerReferral;

    return view('members::referral_management.index', compact('totalReferrals', 'userDetails', 'referralLink','totalReferralPoints',
        'pointsPerReferral'));
}


    /**
     * Show the referral link for the user.
     */
    public function showReferralLink()
    {
        return $this->referralDetails(); 
    }
}
