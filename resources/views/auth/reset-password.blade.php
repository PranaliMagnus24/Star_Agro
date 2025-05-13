@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Reset Password') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Reset Password') }}</li>
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
                    <h5>{{ __('messages.Reset Password') }}</h5>
                </div>
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <form id="registrationForm" method="POST" action="{{ route('password.store') }}" class="farmer-registration-form">
                                @csrf

                                 <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">{{ __('messages.Email') }} <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control" placeholder="{{ __('messages.Enter your email') }}" value="{{ old('email',$request->email)}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                 <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">{{ __('messages.Password') }} <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Enter new password') }}">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">{{ __('messages.Confirm Password') }} <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('messages.Enter confirm password') }}">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- Terms and Conditions Modal -->

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success w-30 py-2">{{ __('messages.Reset Password') }}</button>
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

@endsection




{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf


        <input type="hidden" name="token" value="{{ $request->route('token') }}">


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
