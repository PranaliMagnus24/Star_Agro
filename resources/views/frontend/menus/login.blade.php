@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/bg/bg-banner.webp)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Login') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Login') }}</li>
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
                    <h5>{{ __('messages.Login') }}</h5>
                </div>
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <form id="registrationForm" method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="farmer-registration-form">
                                @csrf

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md">
                                            <label class="form-label">{{ __('messages.Phone Number') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" placeholder="{{ __('messages.Enter your mobile number') }}" value="{{ old('phone')}}">
                                            @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label class="form-label">{{ __('messages.Password') }}</label>
                                            <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Enter your password') }}" value="{{ old('password')}}">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                        <span class="ms-2 text-sm text-gray-600">{{ __('messages.Remember me') }}</span>
                                    </label>
                                    <span class="d-flex text-right">
                                        @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                            {{ __('messages.Forgot your password?') }}
                                        </a>
                                    @endif
                                    </span>

                                </div>




                                <!-- Terms and Conditions Modal -->

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-success w-30 py-2">{{ __('messages.Submit') }}</button>
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
