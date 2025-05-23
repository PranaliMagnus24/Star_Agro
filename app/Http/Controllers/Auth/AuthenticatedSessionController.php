<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use App\Models\User;
use Cache;
use Illuminate\Support\Facades\Session;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('frontend.menus.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     $request->session()->regenerate();

    //     return redirect()->intended(RouteServiceProvider::HOME);
    // }

    public function store(LoginRequest $request): RedirectResponse
    {  
        //  dd($request);
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();
      
         if (!$user) {
        // Log the issue or redirect with an error message
        return redirect()->route('login')->withErrors(['login' => 'Authentication failed.']);
    }
        $userRoles = $user->getRoleNames();
        // dd($userRoles);
        if ($userRoles->contains('admin') || $userRoles->contains('super-admin')) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return redirect()->route('member');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function clearCache()
{
    // Clear application cache
    Artisan::call('cache:clear');
    // Optionally clear other caches too
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    return response()->json([
        'message' => 'All caches cleared successfully.'
    ]);
}

//////// send otp via mobile number
   public function sendOtp(Request $request)
{
    
    try {
        $request->validate([
            'phone' => ['required', 'regex:/^[0-9]{10}$/', 'exists:users,phone'],
        ]);
        $phone = $request->input('phone');
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Invalid phone number.'], 404);
        }
        $otp = rand(100000, 999999);
        Cache::put('otp_'.$phone, $otp, now()->addMinutes(5));

         $message = "Dear User, Your login OTP is $otp. Do not share with anyone. -Star Agro. Thank you. Call 7517513960 - Nashik First";
            \Log::info("OTP for $phone is $otp");
        $postData = [
            // 'authkey'   => '74499AuRsBHOF65828953P1',
            'authkey'=>'453039Aehzt6VtnMYS682d82c5P1',
            'mobiles'   => $phone,
            'sender'    => 'NSKFST',
            'route'     => '4',
            'country'   => '91',
            'DLT_TE_ID' => '1207162399931698582',
            'message'   => $message,
        ];
        $ch = curl_init("http://control.bestsms.co.in/api/sendhttp.php");
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);

        $output = curl_exec($ch);
        if (curl_errno($ch)) {
         return response()->json(['status' => 'error', 'message' => 'Failed to send OTP.'], 500);
        }
        curl_close($ch);
        return response()->json(['status' => 'success', 'message' => 'OTP sent successfully']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Internal Server Error'], 500);
    }
}



/////////////////// verify otp 
public function verifyOtp(LoginRequest $request)
{
    try {
       
        $request->merge(['login_type' => 'otp']); 
        $request->authenticate(); 
        
        $user = $request->user(); 

        if ($user) {
            $request->session()->regenerate();
            return redirect()->route('member');
        }

        return redirect()->route('login')->withErrors(['login' => 'User not found.']);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return back()->withErrors($e->errors());
    }
}


}
