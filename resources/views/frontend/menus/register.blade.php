@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Farmer Registration Form') }}</h2>
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



<section id="faq" class="faq-area pt-120 pb-100" style="background: url(frontend/assets/img/bg/faq-bg.png);background-size: cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="about-title second-atitle mb-30">
                    <h5>{{ __('messages.Farmer Registration Form') }}</h5>
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
                                    </div>
                                </div>

                                <!-- Terms and Conditions Modal -->
                                <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="termsModalLabel">{{ __('messages.Terms and Conditions') }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Your terms and conditions content goes here.</p>
                                                <p>For example:</p>
                                                <ul>
                                                    <li>Term 1: Description of the first term.</li>
                                                    <li>Term 2: Description of the second term.</li>
                                                    <li>Term 3: Description of the third term.</li>
                                                    <!-- Add more terms as needed -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
<script>
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
        var termsCheckbox = document.getElementById('terms');
        if (!termsCheckbox.checked) {
            event.preventDefault();
            alert('You must agree to the Terms and Conditions before submitting the form.');
        }
    });
</script>
