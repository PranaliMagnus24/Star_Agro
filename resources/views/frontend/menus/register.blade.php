@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/bg/bg-banner.webp)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Registration Form') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Register') }}</li>
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
                    <h5>{{ __('messages.Registration Form') }}</h5>
                </div>
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <form id="registrationForm" method="POST" action="{{ route('home.register.store') }}" enctype="multipart/form-data" class="farmer-registration-form">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label"> {{ __('messages.User Type') }} </label>
                                            <select name="roles" id="roles" class="form-control">
                                                <option value="" disabled selected>-- {{ __('messages.Select User Type') }} --</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role }}" @if($role == 'Farmer') selected @endif>{{ ucfirst($role) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.Language') }}</label>
                                            <select name="language" id="language" class="form-control" onchange="location = this.value;">
                                                <option value="" disabled selected>-- Select language --</option>
                                                <option value="{{ url('language/en') }}" {{ App::getLocale() === 'en' ? 'selected' : '' }}>English</option>
                                                <option value="{{ url('language/mr') }}" {{ App::getLocale() === 'mr' ? 'selected' : '' }}>Marathi</option>
                                                <option value="{{ url('language/hi') }}" {{ App::getLocale() === 'hi' ? 'selected' : '' }}>Hindi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.First Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control" placeholder="{{ __('messages.First Name') }}" value="{{ old('first_name')}}">
                                            @error('first_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.Last Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" class="form-control" placeholder="{{ __('messages.Last Name') }}" value="{{ old('last_name')}}">
                                            @error('last_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.Phone') }} <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" placeholder="{{ __('messages.Enter your mobile number') }}" value="{{ old('phone')}}">
                                            @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.Email') }}</label>
                                            <input type="email" name="email" class="form-control" placeholder="{{ __('messages.Enter your email') }}" value="{{ old('email')}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.Password') }}<span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Enter your password') }}" value="{{ old('password')}}">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">{{ __('messages.Confirm Password') }}<span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('messages.Enter your confirm password') }}" value="{{ old('password_confirmation')}}">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="container mt-5">
                                    <!-- Terms and Conditions Checkbox -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="terms" name="terms">
                                        <label class="form-check-label" for="terms">
                                            {{ __('messages.I agree to the') }} <a href="#" data-toggle="modal" data-target="#termsModal">{{ __('messages.Terms and Conditions') }}</a>
                                        </label>
                                        <br>
                                        @error('terms')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    </div>
                                </div>

                                <!-- Terms and Conditions Modal -->
                                <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-custom" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="termsModalLabel">{{ __('messages.Terms and Conditions') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>{{ __('messages.Introduction') }}</h4>
                                                <p><ul>
                                                    <li>1. {{ __('messages.These Terms and Conditions ("Terms") govern your use of the Star Agro Fruits and Vegetables Processing e-commerce site ("Site") and any services provided through it') }}.</li>
                                                    <li>
                                                        2. {{ __('messages.By accessing or using the Site, you agree to be bound by these Terms') }}.
                                                    </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Definitions') }}</h4>
                                                <p><ul>
                                                    <li>
                                                        1. {{ __('messages."User" means any person who accesses or uses the Site')}}.
                                                    </li>
                                                    <li>
                                                        2. {{ __('messages."Customer" means a User who purchases products from the Site')}}.
                                                    </li>
                                                    <li>
                                                        3. {{ __('messages."Product" means any fruit or vegetable product sold on the Site')}}.
                                                    </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Use of the Site') }}</h4>
                                                <p><ul>
                                                    <li>
                                                        1. {{ __('messages.The Site is for personal and non-commercial use only') }}.
                                                    </li>
                                                    <li>
                                                        2. {{ __('messages.You must be at least 18 years old to use the Site') }}.
                                                    </li>
                                                    <li>
                                                        3. {{ __('messages.You agree to provide accurate and complete information when creating an account') }}.
                                                    </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Product Information') }}</h4>
                                                <p><ul>
                                                    <li>
                                                        1. {{ __('messages.Product descriptions and images are for illustrative purposes only') }}.
                                                    </li>
                                                    <li>
                                                        2. {{ __('messages.We strive to ensure product accuracy, but occasional errors may occur') }}.
                                                    </li>
                                                    <li>
                                                        3. {{ __('messages.Product availability and pricing are subject to change') }}.
                                                    </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Ordering and Payment') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.To place an order, you must have a valid payment method') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.Payment must be made in full at the time of order') }}.
                                                        </li>
                                                        <li>
                                                            3. {{ __('messages.We accept [list payment methods]') }}.
                                                        </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Shipping and Delivery') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.We strive to deliver products within [timeframe]') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.Shipping costs and estimated delivery times are provided during checkout') }}.
                                                        </li>
                                                        <li>
                                                            3. {{ __('messages.We are not responsible for delays caused by third-party carriers') }}.
                                                        </li>
                                                    </ul>
                                                </p>

                                                <h4>
                                                    {{ __('messages.Returns and Refunds') }}
                                                </h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.You may return products within [timeframe] for a refund or exchange') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.Products must be in their original condition and packaging') }}.
                                                        </li>
                                                        <li>
                                                            3. {{ __('messages.Refunds will be processed within [timeframe]') }}.
                                                        </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Intellectual Property') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.All content on the Site, including text, images, and logos, is owned by Star Agro Fruits and Vegetables Processing') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.You may not reproduce, distribute, or modify any content without our permission') }}.
                                                        </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Liability') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.We are not liable for any damages or losses resulting from your use of the Site or products') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.We are not responsible for any errors or omissions in product information') }}.
                                                        </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Governing Law') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.These Terms are governed by and construed in accordance with the laws of [State/Country]') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.Any disputes arising from these Terms will be resolved through [dispute resolution process]') }}.
                                                        </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Changes to Terms') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.We reserve the right to modify these Terms at any time') }}.
                                                        </li>
                                                        <li>
                                                            2. {{ __('messages.Changes will be effective immediately upon posting') }}.
                                                        </li>
                                                    </ul>
                                                </p>
                                                <h4>{{ __('messages.Contact Us') }}</h4>
                                                <p>
                                                    <ul>
                                                        <li>
                                                            1. {{ __('messages.If you have any questions or concerns about these Terms, please contact us at [contact email or phone number') }}
                                                        </li>
                                                    </ul>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn ss-btn w-30 py-2">{{ __('messages.Submit') }}</button>
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
<script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
        var termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            event.preventDefault();
            alert('You must agree to the Terms and Conditions before submitting the form.');
        }
    });
</script>
