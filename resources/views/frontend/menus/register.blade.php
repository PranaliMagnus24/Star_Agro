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
<section id="work" class="pt-120 pb-90">
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
</section>

<script>
  $(document).ready(function () {

$('#country-dropdown').on('change', function () {

    var idCountry = this.value;

    $("#state-dropdown").html('');

    $.ajax({

        url: "{{url('api/fetch-states')}}",

        type: "POST",

        data: {

            country_id: idCountry,

            _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function (result) {

            $('#state-dropdown').html('<option value="">-- Select State --</option>');

            $.each(result.states, function (key, value) {

                $("#state-dropdown").append('<option value="' + value

                    .id + '">' + value.name + '</option>');

            });

            $('#city-dropdown').html('<option value="">-- Select City --</option>');

        }

    });

});


$('#state-dropdown').on('change', function () {

    var idState = this.value;

    $("#city-dropdown").html('');

    $.ajax({

        url: "{{url('api/fetch-cities')}}",

        type: "POST",

        data: {

            state_id: idState,

            _token: '{{csrf_token()}}'

        },

        dataType: 'json',

        success: function (res) {

            $('#city-dropdown').html('<option value="">-- Select City --</option>');

            $.each(res.cities, function (key, value) {

                $("#city-dropdown").append('<option value="' + value

                    .id + '">' + value.name + '</option>');

            });

        }

    });

});

});

$(window).on("load", function() {
        var idCountry = $('#country-dropdown').val();
        //alert(idCountry);
        $("#state-dropdown").html('');

        $.ajax({

            url: "{{url('api/fetch-states')}}",

            type: "POST",

            data: {

                country_id: idCountry,

                _token: '{{csrf_token()}}'

            },

            dataType: 'json',

            success: function (result) {

                $('#state-dropdown').html('<option value="">-- Select State --</option>');

                $.each(result.states, function (key, value) {

                    $("#state-dropdown").append('<option value="' + value

                        .id + '">' + value.name + '</option>');

                });

                $('#city-dropdown').html('<option value="">-- Select City --</option>');

            }

        });
    });


</script>
@endsection
