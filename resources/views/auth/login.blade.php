<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email or Phone -->
        <div>
            <x-input-label for="phone" :value="__('Email or Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Login Type Selector -->
        <div class="mt-4">
            <label><input type="radio" name="login_type" value="password" checked> Password Login</label>
            <label class="ms-3"><input type="radio" name="login_type" value="otp"> OTP Login</label>
        </div>

        <!-- Password Section -->
        <div class="mt-4" id="password-section">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Send OTP Button (hidden initially) -->
        <div class="form-group mt-3 d-none" id="send-otp-section">
            <button type="button" class="btn btn-secondary" id="send-otp-btn">Send OTP</button>
            <p id="otp-error" class="text-danger mt-2"></p>
        </div>

        <!-- OTP Input Field (hidden initially) -->
        <div class="form-group mt-3 d-none" id="otp-section">
            <x-input-label for="otp" :value="__('OTP')" />
            <x-text-input id="otp" type="text" name="otp" placeholder="Enter OTP" autocomplete="off" />
            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- forgot password -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- <script>
        const passwordSection = document.getElementById('password-section');
        const sendOtpSection = document.getElementById('send-otp-section');
        const otpSection = document.getElementById('otp-section');
        const passwordInput = document.getElementById('password');
        const otpInput = document.getElementById('otp');
        const sendOtpBtn = document.getElementById('send-otp-btn');
        const phoneInput = document.getElementById('phone');
        const otpError = document.getElementById('otp-error');

        document.querySelectorAll('input[name="login_type"]').forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.value === 'otp' && radio.checked) {
                    passwordSection.classList.add('d-none');
                    passwordInput.disabled = true;

                    sendOtpSection.classList.remove('d-none');
                    otpSection.classList.remove('d-none');
                    otpInput.disabled = false;
                } else {
                    passwordSection.classList.remove('d-none');
                    passwordInput.disabled = false;

                    sendOtpSection.classList.add('d-none');
                    otpSection.classList.add('d-none');
                    otpInput.disabled = true;
                    otpError.textContent = '';
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
                body: JSON.stringify({ phone: phone })
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
    </script> -->
</x-guest-layout>
