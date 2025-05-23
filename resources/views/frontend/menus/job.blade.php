@extends('frontend.layouts.layout')
 @section('title', 'Star Agro - Job Application')
 @section('content')

     <section class="breadcrumb-area d-flex align-items-center"
         style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
         <div class="container">
             <div class="row align-items-center">
                 <div class="col-xl-12 col-lg-12">
                     <div class="breadcrumb-wrap text-left">
                         <div class="breadcrumb-title">
                             <h2>{{ __('messages.Job Application') }}</h2>
                             <div class="breadcrumb-wrap">
                                 <nav aria-label="breadcrumb">
                                     <ol class="breadcrumb">
                                         <li class="breadcrumb-item"><a
                                                 href="{{ route('home.index') }}">{{ __('messages.Home') }}</a></li>
                                         <li class="breadcrumb-item active" aria-current="page">
                                             {{ __('messages.Job Application') }}</li>
                                     </ol>
                                 </nav>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>

     <section id="services2" class="services-area2 pt-50 pb-50 fix p-relative">
         <div class="container"></div>
         <div class="row justify-content-center">
             <div class="col-lg-10">
                 <form method="POST" action="{{ route('home.job.submit') }}" enctype="multipart/form-data"
                     style="border: 2px solid black; padding: 20px; border-radius: 10px;">
                     @csrf
                     <div class="row mb-3">
                        <div class="col-md-6">
                             <label for="first_name">{{ __('messages.First Name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
                         </div>
                         @error('first_name')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror

                         <div class="col-md-6">
                             <label for="last_name">{{ __('messages.Last Name') }} <span class="text-danger">*</span></label>
                             <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
                         </div>
                         @error('last_name')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-6">
                             <label for="phone">{{ __('messages.Phone Number') }} <span class="text-danger">*</span></label>
                             <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
                         </div>
                          @error('phone')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror

                         <div class="col-md-6">
                             <label for="email">{{ __('messages.Email') }}</label>
                             <input type="email" name="email" id="email" class="form-control" value="{{old('email') }}">
                         </div>
                         @error('email')
                          <span class="text-danger">{{ $message }}</span>
                         @enderror

                    </div>
                   
                         <!-- <div class="col-12 mb-3">
                                <label for="address">{{ __('messages.Address') }}</label>
                                <textarea name="address" id="address" rows="2" class="form-control" required></textarea>
                            </div> -->
                         <!-- Country Dropdown (Hidden) -->
                         <div class="mb-3 d-none">
                             <div class="row">
                                 <div class="col-md-6">
                                     <label class="form-label">Country</label>
                                     <select name="country" id="country-dropdown" class="form-select form-control">
                                         @foreach ($countries as $country)
                                             <option value="{{ $country->id }}"
                                                 {{ $country->id == 101 ? 'selected' : '' }}>
                                                 {{ $country->name }}
                                             </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 @error('country')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                         </div>

                         <!-- State and District Dropdowns -->
                         <div class="row mb-3">
                             <div class="col-md-6">
                                     <label for="state" class="col-md-4 col-form-label">{{ __('messages.State') }} <span
                                             class="text-danger">*</span></label>
                                     <div class="col-md-8">
                                         <select name="state" id="state-dropdown" class="form-select form-control">
                                             <option value="">-- Select State --</option>
                                             @foreach ($states as $state)
                                                 <option value="{{ $state->id }}"
                                                     {{ $state->id == 4008 ? 'selected' : '' }}>
                                                     {{ $state->name }}
                                                 </option>
                                             @endforeach
                                         </select>
                                     </div>
                                     @error('state')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                 
                             </div>

                             <div class="col-md-6">
                                     <label for="district" class="col-md-4 col-form-label">{{ __('messages.District') }}
                                         <span class="text-danger">*</span></label>
                                     <div class="col-md-8">
                                         <select name="district" id="city-dropdown" class="form-select form-control">
                                             <option value="">{{__('messages.-- Select District --') }}</option>
                                             @foreach ($cities as $city)
                                                     <option value="{{ $city->id }}"
                                                    {{ old('district') == $city->id ? 'selected' : '' }}>
                                                     {{ $city->district_name }}
                                                    </option>
                                             @endforeach
                                         </select>
                                     </div>
                                     @error('district')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                     <div id="loader" style="display:none; text-align:center; margin-bottom: 15px;">
                                     <img src="{{ asset('frontend/assets/img/loader.gif') }}" alt="Loading..." width="50">
                                    </div>
                             </div>
                         </div>

                         <!-- Taluka and Village Dropdowns -->
                         <div class="row">
                             <div class="col-md-6">        
                                     <label for="taluka" class="col-md-4 col-form-label">{{ __('messages.Taluka') }}
                                         <span class="text-danger">*</span></label>
                                     <div class="col-md-8">
                                         <select name="taluka" id="taluka-dropdown" class="form-select form-control">
                                             <option value="">{{__('messages.--Select Taluka--') }}</option>
                                             @foreach ($talukas as $taluka)
                                                 <option value="{{ $taluka->id }}"
                                                     {{ old('taluka') == $taluka->id ? 'selected' : '' }}>
                                                     {{ $taluka->taluka_name }}
                                                 </option>
                                             @endforeach
                                         </select>
                                    
                                     @error('taluka')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                      <div id="loader" style="display:none; text-align:center; margin-bottom: 15px;">
                                     <img src="{{ asset('frontend/assets/img/loader.gif') }}" alt="Loading..." width="50">
                                    </div>
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 
                                     <label for="village" class="col-md-4 col-form-label">{{ __('messages.Village') }}
                                         <span class="text-danger">*</span></label>
                                     <div class="col-md-8">
                                         <select name="town" id="village-dropdown" class="form-select form-control" value="{{old('town')  }}">
                                             <option value="">{{__('messages.-- Select Village --') }}</option>
                                         </select>
                                     </div>
                                     @error('town')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror
                                      <div id="loader" style="display:none; text-align:center; margin-bottom: 15px;">
                                     <img src="{{ asset('frontend/assets/img/loader.gif') }}" alt="Loading..." width="50">
                                    </div>
                                 
                             </div>
                         </div>
                            

                            <!-- dropdown for Applied for-->
                            <div class="row">
                                 <div class="col-md-6">    
                                     <label for="applying_for" class="col-md-4 col-form-label">{{ __('messages.Applying for')}} <span class="text-danger">*</span></label>
                                      <div class="col-md-8">
                                        <select name="applying_for" id="applying_for-dropdown" class="form-select form-control">
                                            <option value="">{{__('messages.--Please Select--') }}</option>
                                            <option value="district place">{{__('messages.District place') }}</option>
                                            <option value="taluka place">{{__('messages.Taluka place') }}</option>
                                            <option value="village place">{{__('messages.Village place') }}</option>
                                        </select>
                                      </div>
                                       @error('applying_for')
                                         <span class="text-danger">{{ $message }}</span>
                                     @enderror

                                      
                                </div>
                                 <div class="col-md-6">    
                                    
                                </div>
                            </div>
                            <br>
                         <div class="col-12 mb-3">
                             <label for="subject">{{ __('messages.Subject') }} </label>
                             <input type="text" name="subject" id="subject" class="form-control">
                         </div>

                         <div class="col-12 mb-3">
                             <label for="description">{{ __('messages.Description') }} </label>
                             <textarea name="description" id="description" rows="4" class="form-control"></textarea>
                         </div>

                         <div class="col-12 mb-4">
                             <label for="cv">{{ __('messages.Upload CV (PDF or DOC only)') }} <span class="text-danger">*</span></label>
                             <input type="file" name="cv" id="cv" class="form-control"
                                 accept=".pdf,.doc,.docx">
                         </div>
                          @error('cv')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                         

                         <div class="col-12">
                                 <button type="submit"
                                 class="btn ss-btn mr-15">{{ __('messages.Submit') }}</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
         </div>
     </section>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
         $(document).ready(function() {
             //state dropdown 
             $('#country-dropdown').on('change', function() {

                 var idCountry = this.value;

                 $("#state-dropdown").html('');

                 $.ajax({

                     url: "{{ url('home/api/fetch-states') }}",

                     type: "POST",

                     data: {

                         country_id: idCountry,

                         _token: '{{ csrf_token() }}'

                     },

                     dataType: 'json',

                     success: function(result) {

                         $('#state-dropdown').html(
                             '<option value="">-- Select State --</option>');

                         $.each(result.states, function(key, value) {

                             $("#state-dropdown").append('<option value="' + value

                                 .id + '">' + value.name + '</option>');

                         });

                         $('#city-dropdown').html('<option value="">-- Select City --</option>');

                     }

                 });

             });

             //district dropdown 
             $('#state-dropdown').on('change', function() {

                 var idState = this.value;

                 $("#city-dropdown").html('');

                 $.ajax({

                     url: "{{ url('home/api/fetch-cities') }}",

                     type: "POST",

                     data: {

                         state_id: idState,

                         _token: '{{ csrf_token() }}'

                     },

                     dataType: 'json',

                     success: function(res) {

                         $('#city-dropdown').html('<option value="">-- Select City --</option>');

                         $.each(res.cities, function(key, value) {

                             $("#city-dropdown").append('<option value="' + value

                                 .id + '">' + value.name + '</option>');

                         });

                     },
                      complete: function() {
                     $("#loader").hide(); // Hide loader
                     }

                 });

             });
             // Taluka dropdown
             $('#city-dropdown').on('change', function() {
                 var districtId = this.value;
                 $("#taluka-dropdown").html('');
                 $.ajax({
                     url: "{{ url('home/api/fetch-talukas') }}",
                     type: "POST",
                     data: {
                         district_id: districtId,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(result) {
                         $('#taluka-dropdown').html(
                             '<option value="">-- Select Taluka --</option>');
                         $.each(result.talukas, function(key, value) {
                             $("#taluka-dropdown").append('<option value="' + value.id +
                                 '">' + value.taluka_name + '</option>');
                         });
                     },
                     complete: function() {
                     $("#loader").hide(); // Hide loader
                     }
                 });
             });
             // Taluka dropdown
             $('#taluka-dropdown').on('change', function() {
                 var talukaId = this.value;
                 $("#village-dropdown").html('');
                 $.ajax({
                     url: "{{ url('home/api/fetch-villages') }}",
                     type: "POST",
                     data: {
                         taluka_id: talukaId,
                         _token: '{{ csrf_token() }}'
                     },
                     dataType: 'json',
                     success: function(result) {
                         $('#village-dropdown').html(
                             '<option value="">-- Select Village --</option>');
                         $.each(result.villages, function(key, value) {
                             $("#village-dropdown").append('<option value="' + value.id +
                                 '">' + value.village_name + '</option>');
                         });
                     },
                     complete: function() {
                     $("#loader").hide(); // Hide loader
                     }
                 });
             });

         });
     </script>


 @endsection
