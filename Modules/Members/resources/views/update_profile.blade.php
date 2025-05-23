@extends('members::layouts.master')

@section('title', __('messages.Profile'))
@section('pagetitle', __('messages.Profile'))
@section('member')


<section class="section profile">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="nav-item">
                            <button class="nav-link {{ request()->get('tab') == 'profile-edit' ? 'active' : '' }} " data-bs-toggle="tab" data-bs-target="#profile-edit">{{ __('messages.Edit Profile') }}</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link {{ request()->get('tab') == 'profile-change-password' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#profile-change-password">{{ __('messages.More Information') }}</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link {{ request()->get('tab') == 'change-password' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#change-password">{{ __('messages.Change Password') }}</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade {{ request()->get('tab') == 'profile-edit' ? 'show active' : '' }} profile-edit pt-3" id="profile-edit">
                            <!-- Profile Edit Form -->
                            <form method="POST" action="{{ route('member.profile.update')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="first_name" class="col-md-4 col-form-label">{{ __('messages.First Name') }}</label>
                                            <div class="col-md-8">
                                                <input name="first_name" type="text" class="form-control" id="first_name" value="{{ $user->first_name }}">
                                                @error('first_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="last_name" class="col-md-4 col-form-label">{{ __('messages.Last Name') }}</label>
                                            <div class="col-md-8">
                                                <input name="last_name" type="text" class="form-control" id="last_name" value="{{ $user->last_name }}">
                                                @error('last_name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="email" class="col-md-4 col-form-label">{{ __('messages.Email') }}</label>
                                            <div class="col-md-8">
                                                <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                                                @error('email')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label for="phone" class="col-md-4 col-form-label">{{ __('messages.Phone') }}</label>
                                            <div class="col-md-8">
                                                <input name="phone" type="text" class="form-control" id="phone" value="{{ $user->phone }}">
                                                @error('phone')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.Update') }}</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>

                        <div class="tab-pane fade {{ request('tab') == 'profile-change-password' ? 'show active' : '' }} pt-3" id="profile-change-password">
                            <!-- More information Form -->
                            <form method="POST" action="{{ route('member.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="gender" class="col-md-4 col-form-label">{{ __('messages.Gender') }}</label>
                                            <div class="col-md-8">
                                               <select name="gender" id="gender" class="form-control">
                                                <option value="">-- Select Gender --</option>
                                                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                               </select>
                                            </div>
                                            @error('gender')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="dob" class="col-md-4 col-form-label">{{ __('messages.Date Of Birth') }}</label>
                                            <div class="col-md-8">
                                                <input type="date" class="form-control" name="dob" id="dob" value="{{ old('dob', $user->dob)}}">
                                            </div>
                                            @error('dob')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

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
                                        @error('country')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                @if(auth()->user() && auth()->user()->hasRole('company'))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="company_name" class="col-md-4 col-form-label">{{ __('messages.Company Name') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="company_name" id="company_name" value="{{ old('company_name', $user->company_name) }}">
                                            </div>
                                            @error('company_name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="state" class="col-md-4 col-form-label">{{ __('messages.State') }}</label>
                                            <div class="col-md-8">
                                               <select name="state" id="state-dropdown" class="form-control">
                                                <option value="">-- Select State --</option>
                                                @foreach ($states as $state)

                                                <option value="{{ $state->id }}" {{ $state->id == 4008 ? 'selected' : '' }}>{{ $state->name }}</option>
                                                @endforeach
                                               </select>
                                            </div>
                                            @error('state')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="district" class="col-md-4 col-form-label">{{ __('messages.District') }}</label>
                                            <div class="col-md-8">
                                                <select name="district" id="city-dropdown" class="form-control">
                                                    <option value="">-- Select District --</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}" {{ $city->id == 133177 ? 'selected' : '' }}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('district')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="state" class="col-md-4 col-form-label">{{ __('messages.Zip Code') }}</label>
                                            <div class="col-md-8">
                                                <input name="pincode" type="text" class="form-control" id="zip_code" value="{{ old('pincode', $user->pincode)}}">
                                            </div>
                                            @error('pincode')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="state" class="col-md-4 col-form-label">{{ __('messages.Taluka') }}</label>
                                            <div class="col-md-8">
                                                <input name="taluka" type="text" class="form-control" id="taluka" value="{{ old('taluka', $user->taluka)}}">
                                            </div>
                                            @error('taluka')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="state" class="col-md-4 col-form-label">{{ __('messages.Town/Village') }}</label>
                                            <div class="col-md-8">
                                                <input name="town" type="text" class="form-control" id="town" value="{{ old('town', $user->town)}}">
                                            </div>
                                            @error('town')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="referral_code" class="col-md-4 col-form-label">{{ __('messages.Referral Code') }}</label>
                                            <div class="col-md-8">
                                                <input type="text" name="referral_code" id="referral_code" class="form-control" value="{{ old('referral_code', $user->referral_code)}}">
                                            </div>
                                            @error('referral_code')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @if(auth()->user() && auth()->user()->hasRole('farmer'))
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="farmer_certificate" class="col-md-4 col-form-label">{{ __('messages.Farmer Certificate') }}, 7/12 {{ __('messages.Certificate') }}</label>
                                            <div class="col-md-8">
                                                <input type="file" name="farmer_certificate" id="farmer_certificate" class="form-control">
                                                @if($user->farmerDocument && !empty($user->farmerDocument->farmer_certificate))
                                                    <div class="mt-2">
                                                        <a href="{{ asset('upload/farmer_documents/' . $user->id . '/' . $user->farmerDocument->farmer_certificate) }}" target="_blank">
                                                            View Uploaded Certificate
                                                        </a>
                                                    </div>
                                                @else
                                                    <p>No certificate uploaded yet.</p>
                                                @endif
                                            </div>
                                            @error('farmer_certificate')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @if(auth()->user() && auth()->user()->hasRole('entrepreneur'))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-form-label">{{ __('messages.Company Logo') }}</label>
                                            <div class="col-md-8">
                                                <input type="file" name="company_logo" id="company_logo" class="form-control">
                                                @php
                                                $companyLogo = \App\Models\FarmerDocuments::where('user_id', $user->id)
                                                                ->where('document_type', 'company_logo')
                                                                ->first();
                                            @endphp

                                            @if($companyLogo && $companyLogo->file_path)
                                                <div class="mt-2">
                                                    <strong>Uploaded Logo:</strong><br>
                                                    <img src="{{ asset('upload/farmer_documents/' . $user->id . '/' . $companyLogo->file_path) }}"
                                                         alt="Company Logo" style="max-width: 150px; border: 1px solid #ddd; padding: 4px;">
                                                </div>
                                            @endif
                                            </div>
                                            @error('company_logo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-form-label">{{ __('messages.Upload Documents') }}</label>
                                            <div class="col-md-8">
                                                <select name="upload_documents" id="upload_documents" class="form-control">
                                                    <option value="">--Select documents options--</option>
                                                    <option value="gst-certificate" {{ old('upload_documents', $user->upload_documents ?? '') == 'gst-certificate' ? 'selected' : '' }}>
                                                        {{ __('messages.GST certificate') }}
                                                    </option>
                                                    <option value="aadhar-certificate" {{ old('upload_documents', $user->upload_documents ?? '') == 'aadhar-certificate' ? 'selected' : '' }}>
                                                        {{ __('messages.Udyog aadhar certificate') }}
                                                    </option>
                                                </select>

                                              <br>
                                                <input type="file" name="documents" class="form-control">
                                                @if($user)
    @php
        $farmerDocument = \App\Models\FarmerDocuments::where('user_id', $user->id)
                            ->where('document_type', $user->upload_documents)
                            ->first();
    @endphp

    @if($farmerDocument && $farmerDocument->file_path)
        <div class="mt-2">
            <strong>Uploaded Document:</strong>
            <a href="{{ asset('upload/farmer_documents/' . $user->id . '/' . $farmerDocument->file_path) }}" target="_blank">View File</a>
        </div>
    @endif
@endif
                                            </div>
                                            @error('upload_documents')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @if(auth()->user() && auth()->user()->hasRole('farmer'))
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-form-label">{{ __('messages.Solar Dryer') }}</label>
                                            <div class="col-md-8">
                                                <select name="solar_dryer" class="form-control">
                                                    <option value="yes" {{ old('solar_dryer', $user->solar_dryer) == 'yes' ? 'selected' : '' }}>{{ __('messages.Yes') }}</option>
                                                    <option value="no" {{ old('solar_dryer', $user->solar_dryer) == 'no' ? 'selected' : '' }}>{{ __('messages.No') }}</option>
                                                </select>

                                            </div>
                                            @error('solar_dryer')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-form-label">{{ __('messages.How do you know about us') }}</label>
                                            <div class="col-md-6">
                                                <select name="known_about_us" id="known_about_us" class="form-control">
                                                    <option value="">--Select options--</option>
                                                    <option value="social_media" {{ old('known_about_us', $user->known_about_us ?? '') == 'social_media' ? 'selected' : '' }}>Social Media</option>
                                                    <option value="seminar" {{ old('known_about_us', $user->known_about_us ?? '') == 'seminar' ? 'selected' : '' }}>Seminar</option>
                                                </select>


                                                {{-- <input type="text" name="known_about_us" id="known_about_us" class="form-control" value="{{ old('known_about_us', $user->known_about_us)}}"> --}}
                                            </div>
                                            @error('known_about_us')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{ __('messages.Save') }}</button>
                                </div>
                            </form><!-- End More information form -->
                        </div>
                        <div class="tab-pane fade {{ request('tab') == 'change-password' ? 'show active' : '' }} pt-3" id="change-password">
                            <form action="{{ route('updatePassword')}}" method="POST">
                                @csrf
                                <div class="row mb-3">
                                <label for="CurrentPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Current Password') }}</label>
                                <div class="col-md-8 col-lg-3">
                                <input type="password" class="form-control" id="currentPassword" name="current_password">
                               </div>
                               @error('current_password')
                               <span class="text-danger">{{$message}}</span>
                               @enderror

                               <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.New Password') }}</label>
                               <div class="col-md-8 col-lg-3">
                               <input type="password" class="form-control" id="newPassword" name="new_password">
                               </div>
                               @error('new_password')
                               <span class="text-danger">{{$message}}</span>
                               @enderror
                                </div>

                                <div class="row mb-3">
                                <label for="confirmPassword" class="col-md-4 col-lg-3 col-form-label">{{ __('messages.Confirm New Password') }}</label>
                               <div class="col-md-8 col-lg-3">
                               <input type="password" class="form-control" id="confirmPassword" name="confirm_password">
                               </div>
                               @error('confirm_password')
                               <span class="text-danger">{{$message}}</span>
                               @enderror
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-primary">{{ __('messages.Update Password') }}</button>
                                </div>


                            </form>

                        </div>


                    </div><!-- End Bordered Tabs -->
                </div>
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


</script>
@endsection
