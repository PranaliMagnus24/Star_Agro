@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Forgot your password?') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Forgot your password?') }}</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section id="faq" class="faq-area pb-100 register" style="background: url(frontend/assets/img/bg/faq-bg.png);background-size: cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="about-title second-atitle mb-30">
                    <h5>{{ __('messages.Forgot your password?') }}</h5>
                </div>
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <form id="registrationForm" method="POST" action="{{ route('password.email') }}" enctype="multipart/form-data" class="farmer-registration-form">
                                @csrf

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">{{ __('messages.Email') }} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" placeholder="{{ __('messages.Enter your email') }}" value="{{ old('email')}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Terms and Conditions Modal -->

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn ss-btn w-30 py-2">{{ __('messages.Email Password Reset Link') }}</button>
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
    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>


    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}
@endsection
