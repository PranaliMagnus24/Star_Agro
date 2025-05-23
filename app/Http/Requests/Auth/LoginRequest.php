<?php

namespace App\Http\Requests\Auth;

use App\Http\Middleware\Authenticate;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Cache;


class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
{
    if ($this->input('login_type') === 'otp') {
        return [
            'phone' => ['required', 'string'],
            'otp' => ['required', 'digits:6'], // or adjust OTP length
        ];
    } else {
        return [
            'phone' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
}


    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function authenticate(): void
    // {
    //     $this->ensureIsNotRateLimited();

    //    $credentials = $this->only('password');

    //     if (filter_var($this->input('phone'), FILTER_VALIDATE_EMAIL)) {
    //         $credentials['email'] = $this->input('phone');
    //     } else {
    //         $credentials['phone'] = $this->input('phone');
    //     }

    //     if (! Auth::attempt($credentials, $this->boolean('remember'))) {
    //         RateLimiter::hit($this->throttleKey());

    //         throw ValidationException::withMessages([
    //             'phone' => __('auth.failed'),
    //         ]);
    //     }

    //     RateLimiter::clear($this->throttleKey());
    // }

    public function authenticate(): void
{   
    $this->ensureIsNotRateLimited();

    if ($this->input('login_type') === 'otp') {
        $phone = $this->input('phone');
        $otp = $this->input('otp');


        // Verify OTP
        $cachedOtp = Cache::get('otp_' . $phone);
        if ($otp != $cachedOtp) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'otp' =>__('messages.Invalid OTP code.'),
            ]);
        }
        // OTP valid, log in the user
        $user = User::where('phone', $phone)->first();
        if (!$user) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'phone' =>__('messages.No user found with this phone.'),
            ]);
        }
        Auth::login($user, $this->boolean('remember'));
    } else {
        $credentials = $this->only('password');
        if (filter_var($this->input('phone'), FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $this->input('phone');
        } else {
            $credentials['phone'] = $this->input('phone');
        }

        // if (!Auth::attempt($credentials, $this->boolean('remember'))) {
        //     RateLimiter::hit($this->throttleKey());
        //     throw ValidationException::withMessages([
        //         'phone' => __('auth.failed'),
        //     ]);
        // }
        $user = User::where('phone', $this->input('phone'))->orWhere('email', $this->input('phone'))->first();

        if (!$user) {
                                    RateLimiter::hit($this->throttleKey());
                                throw ValidationException::withMessages([
                            'phone' =>__('messages.No user found with this phone or email.'),
        ]);
        }

            if (!Auth::attempt($credentials, $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                'password' =>__('messages.The password you entered is incorrect.'),
         ]);
        }

    }

    RateLimiter::clear($this->throttleKey());
}

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  
     public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
                'phone' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('phone')).'|'.$this->ip());
    }
    public function messages(): array
{
    return [
        'phone.required' =>__('messages.The phone or email field is required.'),
        'password.required' =>__('messages.The password field is required.'),
        'phone.digits' => __('messages.Phone number must be exactly 10 digits.'),
    ];
}

}
