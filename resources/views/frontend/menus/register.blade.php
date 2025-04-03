@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>Registration Form</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- <section id="work" class="pt-120 pb-90">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6 form-container">
                <h3 class="text-center text-success">Farmer Registration Form</h3>
                <form method="POST" action="{{ route('home.register.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name')}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter your mobile number" value="{{ old('phone')}}">
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email')}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Password<span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password" value="{{ old('password')}}">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Enter your confirm password" value="{{ old('password_confirmation')}}">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select form-control" name="gender">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            @error('gender')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="col-md-6">
                                <label class="form-label">Date Of Birth</label>
                                <input type="date" name="dob" class="form-control" value="{{ old('dob')}}">
                                @error('dob')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="text-dark">
                    <div class="mb-3 d-none">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Country</label>
                                <select name="country" id="country-dropdown" class="form-select form-control">
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == 101 ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">State</label>
                                <select name="state" id="state-dropdown" class="form-select form-control">
                                    <option selected> -- Select State -- </option>
                                    <option value=""></option>
                                </select>
                            </div>
                            @error('state')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="col-md-6">
                                <label class="form-label">District</label>
                                <select name="district" id="city-dropdown" class="form-select form-control">
                                    <option selected> -- Select District -- </option>
                                    <option value=""></option>
                                </select>
                            </div>
                            @error('district')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Taluka</label>
                                <input type="text" name="taluka" class="form-control" placeholder="Enter your taluka" value="{{ old('taluka')}}">
                                @error('taluka')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Town/Village</label>
                                <input type="text" name="town" class="form-control" placeholder="Enter your town/village" value="{{ old('town')}}">
                                @error('town')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Referral Code</label>
                                <input type="text" name="referral_code" class="form-control" placeholder="Enter your Referral Code" value="{{ old('referral_code')}}">
                                @error('referral_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">How do you know about us</label>
                                <input type="text" name="about_us" class="form-control" placeholder="How do you know about us" value="{{ old('about_us')}}">
                                @error('about_us')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Farmer Certificate</label>
                                <input type="file" name="farmer_certificate" class="form-control" placeholder="Enter Center Number">
                                @error('farmer_certificate')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type</label>
                                <select name="roles" id="roles" class="form-control">
                                    <option value="" disabled selected>-- Select --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success w-30">Register</button>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <img src="{{ asset('frontend/assets/img/bg/faq-bg.png') }}" alt="Registration Image" class="img-fluid">
            </div>
        </div>
    </div>
</section> --}}


<section id="faq" class="faq-area pt-120 pb-100" style="background: url(frontend/assets/img/bg/faq-bg.png);background-size: cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8">
                <div class="about-title second-atitle mb-30">
                    <h5>Farmer Registration Form</h5>
                </div>
                <div class="faq-wrap">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <form id="registrationForm" method="POST" action="{{ route('home.register.store') }}" enctype="multipart/form-data" class="farmer-registration-form">
                                @csrf
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label"> User Type </label>
                                            <select name="roles" id="roles" class="form-control">
                                                <option value="" disabled selected>-- Select User Type --</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Language</label>
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
                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name')}}">
                                            @error('first_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name')}}">
                                            @error('last_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control" placeholder="Enter your mobile number" value="{{ old('phone')}}">
                                            @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email')}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Password<span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter your password" value="{{ old('password')}}">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Confirm Password<span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter your confirm password" value="{{ old('password_confirmation')}}">
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
                                            I agree to the <a href="#" data-toggle="modal" data-target="#termsModal">Terms and Conditions</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Terms and Conditions Modal -->
                                <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
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
                                    <button type="submit" class="btn btn-success w-30 py-2">Submit</button>
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
