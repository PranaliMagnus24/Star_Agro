@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

    {{-- <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(/frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Crops') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Crops') }}</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section> --}}
    <section id="blog" class="blog-area  p-relative pt-120 pb-70 fix crops">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="section-title center-align mb-50 text-center">
                        <h5>{{ __('messages.Crops') }}</h5>
                        <h2>{{ __('messages.Latest Crops') }}</h2>
                    </div>

                </div>
            </div>

            <div class="row">
                <!-- Right Column - Cards Section -->
                <div class="col-12 col-md-9">
                    <h5 class="mb-3">{{ $currentCategory->category_name }}</h5>

                    @if ($cropManagements->isEmpty())
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-circle"></i> {{ __('messages.No data available') }}
                        </div>
                    @else
                        <div class="row">
                            @foreach ($cropManagements as $cropManagement)
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <div class="card border-0 shadow-sm" style="max-width: 250px;">
                                        <!-- Image Section -->
                                        <div class="product-image">
                                            <div id="carousel-{{ $cropManagement->id }}" class="carousel slide"
                                                data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @if ($cropManagement->images->isNotEmpty())
                                                        @foreach ($cropManagement->images as $index => $image)
                                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                <img src="{{ asset($image->crop_images) }}" alt="Crop Image"
                                                                    class="card-img-top img-fluid"
                                                                    style="height: 180px; object-fit: cover;">
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="carousel-item active">
                                                            <img src="{{ asset('frontend/assets/img/dummy.jpg') }}"
                                                                alt="Dummy Image" class="card-img-top img-fluid"
                                                                style="height: 180px; object-fit: cover;">
                                                        </div>
                                                    @endif
                                                </div>
                                                <a class="carousel-control-prev" href="#carousel-{{ $cropManagement->id }}"
                                                    role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel-{{ $cropManagement->id }}"
                                                    role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Content Section -->
                                        <div class="card-body p-2">
                                            <h6 class="card-title text-truncate mb-1">
                                                <a href="#" class="text-dark">{{ $cropManagement->crop_name }}</a>
                                            </h6>

                                            <!-- Type and Price in Same Row -->
                                            <p class="d-flex align-items-center mb-1">
                                                @if (!empty($cropManagement->type))
                                                    <i class="fas fa-seedling text-success mr-1"></i>
                                                    <small class="text-muted">{{ ucfirst($cropManagement->type) }}</small>
                                                @endif

                                                <span class="ml-auto">
                                                    <i class="fas fa-rupee-sign text-success"></i>
                                                    <strong
                                                        class="text-success">{{ $cropManagement->expected_price }}</strong>
                                                </span>
                                            </p>

                                            <!-- Planting Date -->
                                            <p class="d-flex align-items-center small text-muted mb-2">
                                                <i class="fas fa-calendar-alt text-success mr-1"></i>
                                                {{ $cropManagement->formatted_planating_date }}
                                            </p>

                                            <!-- Inquiry Button and Favorite Icon in Same Row -->
                                            <div class="d-flex justify-content-between align-items-center">
                                                @if ($cropManagement->hasInquired)
                                                    <a href="{{ route('crop.details', $cropManagement->id) }}"
                                                        id="inquiryButton-{{ $cropManagement->id }}"
                                                        class="btn btn-primary btn-sm px-2 py-1 rounded-pill"
                                                        style="height: 25px; width: 100px; display: block; border-radius: 15px;">
                                                        {{ __('messages.View Details') }}
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);"
                                                        id="inquiryButton-{{ $cropManagement->id }}"
                                                        class="btn ss-btn mr-15 px-2 py-1 rounded-pill"
                                                        style="height: 25px; width: 80px; display: block; border-radius: 15px;"
                                                        data-toggle="modal" data-id="{{ $cropManagement->id }}"
                                                        data-target="#inquiryModal"
                                                        onclick="handleInquiryClick('{{ $cropManagement->id }}')">
                                                        {{ __('messages.Inquiry') }}
                                                    </a>
                                                @endif

                                                <i class="fas fa-heart favorite-icon"
                                                    style="font-size: 16px; cursor: pointer; color: {{ $cropManagement->isFavorited() ? 'red' : '#ccc' }};"
                                                    onclick="toggleFavorite({{ $cropManagement->id }}, this)">
                                                </i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- Left Column - Related Categories Section -->
                <div class="col-12 col-md-3 mb-3">
                    <div class="card p-3 border-0 shadow-sm">

                        <h6 class="mb-3 border-bottom pb-2">{{ __('messages.Related Categories') }}</h6>
                        <ul class="list-unstyled">
                            @foreach ($relatedCategories as $category)
                                <li class="d-flex align-items-center py-2 border-bottom">
                                    <!-- Category Image -->
                                    <img src="{{ $category->category_image ? asset($category->category_image) : asset('frontend/assets/img/dummy.jpg') }}"
                                        alt="{{ $category->category_name }}" class="rounded-circle mr-2"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                    <!-- Category Name -->
                                    <a href="{{ route('crop.management.list', $category->id) }}"
                                        class="text-dark flex-grow-1">
                                        {{ $category->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>





        </div>


        <div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog" aria-labelledby="inquiryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="inquiryModalLabel">{{ __('messages.Inquiry Form') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form id="inquiryForm" action="{{ route('home.cropsInquiry') }}" method="POST">
                            @csrf
                            <input type="hidden" name="crop_management_id" id="crop_management_id"
                                value="{{ isset($cropManagement) ? $cropManagement->id : '' }}">
                            <div class="row mb-3">
                                <!-- <div class="col-md-6">
                                            <label for="user_name">{{ __('messages.Name') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="user_name">
                                            @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                                        </div> -->
                                <div class="col-md-6">
                                    <label for="user_name">{{ __('messages.Name') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="user_name"
                                        value="{{ old('name', auth()->user()->name ?? '') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- <div class="col-md-6">
                                            <label for="user_phone">{{ __('messages.Phone') }}<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="mobile_number" id="user_phone">
                                            @error('mobile_number')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                                        </div> -->
                                <div class="col-md-6">
                                    <label for="user_phone">{{ __('messages.Phone') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mobile_number" id="user_phone"
                                        value="{{ old('mobile_number', auth()->user()->phone ?? '') }}">
                                    @error('mobile_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <!-- <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="user_email">{{ __('messages.Email') }}</label>
                                            <input type="text" class="form-control" name="email" id="user_email">
                                            @error('email')
        <span class="text-danger">{{ $message }}</span>
    @enderror
                                        </div> -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="user_email">{{ __('messages.Email') }}</label>
                                    <input type="text" class="form-control" name="email" id="user_email"
                                        value="{{ old('email', auth()->user()->email ?? '') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <!-- </div> -->

                                <div class="col-md-6">
                                    <label for="user_phone">{{ __('messages.City') }}</label>
                                    <select name="city" id="" class="form-control">
                                        <option value="">-- Select District --</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                {{ $city->id == 133177 ? 'selected' : '' }}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cropName">{{ __('messages.Description') }}<span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cropName">{{ __('messages.Crop Name') }}</label>
                                <input type="text" class="form-control" name="crop_name"
                                    value="{{ isset($cropManagement) ? $cropManagement->crop_name : '' }}" id="cropName"
                                    readonly>

                                @error('crop_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center slider-btn">
                                <button type="submit" class="btn ss-btn w-30 py-2"
                                    style="height: 46px;">{{ __('messages.Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- Inquiry Modal End -->
    </section>
@endsection

<script>
    function toggleFavorite(cropId, element) {
        @if (Auth::check())
            let isFavorited = element.style.color === 'red';
            let route = isFavorited ? '{{ route('favorite.remove') }}' : '{{ route('favorite.add') }}';

            fetch(route, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        crop_management_id: cropId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        element.style.color = isFavorited ? 'black' : 'red';
                    }
                });
        @else
            window.location.href = '/login';
        @endif
    }

    function handleInquiryClick(cropId) {
    @if (Auth::check())
        // Make an AJAX request to check the wallet balance
        $.ajax({
            url: '{{ route('check.balance') }}', // Use the correct route for checking wallet balance
            method: 'POST',
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: JSON.stringify({
                crop_management_id: cropId
            }), // Send the crop ID in the request body
            success: function(data) {
                if (data.success) {
                    // If the balance is sufficient, show the modal
                    document.getElementById('crop_management_id').value = cropId;
                    $('#inquiryModal').modal('show');
                } else {
                    // If the balance is insufficient, show an error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Insufficient Balance',
                        text: data.message || 'Insufficient balance, please recharge your wallet.',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        confirmButtonText: 'Recharge',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to recharge page or trigger recharge action
                            window.location.href ='{{ route('wallet.management.index') }}';  // Replace with your actual recharge route
                        }
                    });
                }
            },
            error: function(xhr) {
                // Handle any errors that occur during the AJAX request
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong. Please try again.',
                });
            }
        });
    @else
        window.location.href = '/login';
    @endif
}



    // inquiry===>view details

    // document.getElementById('inquiryForm').addEventListener('submit', function(event) {
    //     event.preventDefault();
    //     alert('Inquiry submitted for ' + document.getElementById('cropManagementId').value);
    //     $('#inquiryModal').modal('hide');
    // });
</script>

<!-- <script>
    document.getElementById('inquiryForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Change the Inquiry button to View Details
                    const inquiryButton = document.getElementById('inquiryButton');
                    inquiryButton.textContent = 'View Details';
                    inquiryButton.setAttribute('onclick',
                        `window.location.href='{{ url('crop/details') }}/${data.enquiry_id}'`);

                    // Hide the inquiry modal
                    $('#inquiryModal').modal('hide');

                    // Show success message
                    Swal.fire('Success', data.message, 'success');
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'An error occurred while submitting the inquiry.', 'error');
            });
    });
</script> -->
<script>
    document.getElementById('inquiryForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const cropId = document.getElementById('crop_management_id')
        .value; // Get the crop ID from the hidden input

        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Response:', data);
                if (data.success) {
                    // Change the Inquiry button to View Details
                    const inquiryButton = document.getElementById(`inquiryButton-${cropId}`);
                    // inquiryButton.textContent = 'View Details';
                    inquiryButton.classList.remove('btn-success');
                    inquiryButton.classList.add('btn-primary');
                    // inquiryButton.setAttribute('onclick',
                    //     `window.location.href='{{ url('crop/details') }}/${data.enquiry_id}'`);

                    // Hide the inquiry modal
                    $('#inquiryModal').modal('hide');

                    // Show success message
                    Swal.fire('Success', data.message, 'success');
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                Swal.fire('Error', 'An error occurred while submitting the inquiry.', 'error');
            });
    });
</script>