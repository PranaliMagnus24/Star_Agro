@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

    <section class="breadcrumb-area d-flex align-items-center"
        style="background-image:url(frontend/assets/img/bg/bg-banner.webp)">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="breadcrumb-wrap text-left">
                        <div class="breadcrumb-title">
                            <h2>{{ __('messages.Login') }}</h2>
                            <div class="breadcrumb-wrap">

                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{ route('home.index') }}">{{ __('messages.Home') }}</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Login') }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <section id="faq" class="faq-area pb-100 register"
        style="background: url(frontend/assets/img/bg/faq-bg.png);background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <div class="about-title second-atitle mb-30">
                        <h5>{{ __('messages.Login') }}</h5>
                    </div>
                    <div class="faq-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <form id="registrationForm" method="POST" action="{{ route('login') }}"
                                    enctype="multipart/form-data" class="farmer-registration-form">
                                    @csrf

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md">
                                                <!-- <label class="form-label">{{ __('messages.Email') }} <span class="text-danger">*</span></label>
                                                <input type="email" name="email" class="form-control" placeholder="{{ __('messages.Enter your email') }}" value="{{ old('email') }}">
                                                @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror -->
                                                <label class="form-label">{{ __('messages.Email or Phone') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="{{ __('messages.Enter your registered email or phone') }}"
                                                    value="{{ old('phone') }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <!-- <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <label class="form-label">{{ __('messages.Password') }}</label>
                                                <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Enter your password') }}" value="{{ old('password') }}">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                 @enderror
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                                <!-- Radio buttons -->
                                                <label classs="ms-4"><input type="radio" name="login_type" value="password" checked>
                                                    {{ __('messages.Password Login') }}</label>
                                                <label class="ms-4"><input type="radio" name="login_type"
                                                        value="otp"> {{ __('messages.OTP Login') }}</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3" id="password-section">
                                        <label class="form-label">{{ __('messages.Password') }}</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="{{ __('messages.Enter your password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="mb-3 d-none" id="send-otp-section">
                                        <button type="button" class="btn ss-btn w-30 py-2"
                                            id="send-otp-btn">{{ __('messages.Send OTP') }}</button>
                                        <p id="otp-error" class="text-danger mt-2"></p>
                                    </div>

                                    <div class="mb-3 d-none" id="otp-section">
                                        <label class="form-label">OTP</label>
                                        <input type="text" name="otp" id="otp" class="form-control"
                                            placeholder="{{ __('messages.Enter OTP') }}">
                                        @error('otp')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="block mt-4" id="password-options">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                name="remember">
                                            <span
                                                class="ms-2 text-sm text-gray-600">{{ __('messages.Remember me') }}</span>
                                        </label>
                                        <span class="d-flex text-right">
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('messages.Forgot your password?') }}
                                                </a>
                                            @endif
                                        </span>
                                    </div>





                                    <!-- Terms and Conditions Modal -->

                                    <div class="d-flex justify-content-center slider-btn">
                                        <button type="submit"
                                            class="btn ss-btn w-30 py-2">{{ __('messages.Submit') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <!-- You can add additional content here if needed -->
                </div>
            </div>
        </div>
    </section>
    <script>
        const passwordSection = document.getElementById('password-section');
        const sendOtpSection = document.getElementById('send-otp-section');
        const otpSection = document.getElementById('otp-section');
        const otpError = document.getElementById('otp-error');
        const sendOtpBtn = document.getElementById('send-otp-btn');
        const otpInput = document.getElementById('otp');
        const phoneInput = document.querySelector('input[name="phone"]');
        const passwordOptions = document.getElementById('password-options');


        document.querySelectorAll('input[name="login_type"]').forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'otp' && radio.checked) {
                    passwordSection.classList.add('d-none');
                    sendOtpSection.classList.remove('d-none');
                    otpSection.classList.remove('d-none');
                    passwordOptions.classList.add('d-none'); // Hide Remember me & Forgot password
                } else {
                    passwordSection.classList.remove('d-none');
                    sendOtpSection.classList.add('d-none');
                    otpSection.classList.add('d-none');
                    otpError.textContent = '';
                    passwordOptions.classList.remove('d-none'); // Show Remember me & Forgot password
                }
            });
        });

        sendOtpBtn.addEventListener('click', () => {
            const phone = phoneInput.value.trim();
            if (!phone) {
                otpError.textContent = 'Please enter your phone or email first.';
                return;
            }

            otpError.textContent = '';
            sendOtpBtn.disabled = true;
            sendOtpBtn.textContent = 'Sending...';

            fetch("{{ route('send.otp') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        phone: phone
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        sendOtpBtn.textContent = 'OTP Sent!';
                    } else {
                        sendOtpBtn.disabled = false;
                        sendOtpBtn.textContent = 'Send OTP';
                        otpError.textContent = data.message || 'Failed to send OTP';
                    }
                })
                .catch(() => {
                    sendOtpBtn.disabled = false;
                    sendOtpBtn.textContent = 'Send OTP';
                    otpError.textContent = 'Something went wrong. Try again.';
                });
        });
    </script>


@endsection
