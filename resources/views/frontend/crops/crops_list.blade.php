@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<style>


</style>
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(/frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>Crops</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Crops</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="blog" class="blog-area  p-relative pt-120 pb-70 fix">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="section-title center-align mb-50 text-center">
                    <h5>Crops</h5>
                    <h2>
                        Letest Crops
                    </h2>


                </div>

            </div>
        </div>

        <div class="row">
            @foreach($cropManagements as $cropManagement)
            <div class="col-xs-12 col-md-6 bootstrap snippets bootdeys">
                <div class="product-content product-wrap clearfix">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-image">
                                <!-- Carousel for images -->
                                <div id="carousel-{{ $cropManagement->id }}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($cropManagement->images as $index => $image)
                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                            <img src="{{ asset($image->crop_images) }}" alt="Crop Image" class="img-responsive" style="width: 194px; height: 228px; object-fit: cover;">
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-{{ $cropManagement->id }}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-{{ $cropManagement->id }}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="product-deatil">
                                <h5 class="name">
                                    <a href="#">{{ $cropManagement->crop_name }} <span>{{ $cropManagement->type }}</span>
                                    </a>
                                </h5>

                                <p class="price-container mt-2">
                                    <span><span>₹</span>{{ $cropManagement->expected_price }}</span>
                                    <span class="tag2 hot">
                                        <i class="fas fa-heart favorite-icon"
                                           style="font-size: 19px; color: {{ $cropManagement->isFavorited() ? 'red' : 'white' }};"
                                           onclick="toggleFavorite({{ $cropManagement->id }}, this)"></i>
                                    </span>
                                </p>
                                <span class="tag1"></span>
                            </div>
                            <div class="description">
                                <p>{{ $cropManagement->formatted_planating_date }}</p>
                            </div>
                            <div class="product-info smart-form">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <a href="javascript:void(0);" class="btn btn-success" data-toggle="modal" data-id="{{ $cropManagement->id }}" data-target="#inquiryModal" onclick="setCropName('{{ $cropManagement->id }}')">Inquiry</a>

                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <!-- You can add more buttons or information here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <div class="modal fade" id="inquiryModal" tabindex="-1" role="dialog" aria-labelledby="inquiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inquiryModalLabel">Inquiry Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="inquiryForm" action="{{ route('home.cropsInquiry')}}" method="POST">
                        @csrf
                        <input type="hidden" name="crop_management_id" id="crop_management_id" value="{{$cropManagement->id}}">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="user_name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="user_name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="user_phone">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mobile_number" id="user_phone">
                                @error('mobile_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="user_email">Email</label>
                                <input type="text" class="form-control" name="email" id="user_email">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="user_phone">City</label>
                                <select name="city" id="" class="form-control">
                                    <option value="">-- Select District --</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ $city->id == 133177 ? 'selected' : '' }}>{{ $city->name }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cropName">Description <span class="text-danger">*</span></label>
                           <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                           @error('description')
                           <span class="text-danger">{{$message}}</span>
                           @enderror
                        </div>
                        <div class="form-group">
                            <label for="cropName">Crop Name</label>
                            <input type="text" class="form-control" name="crop_name" value="{{$cropManagement->crop_name}}" id="cropName" readonly>
                            @error('crop_name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="submit-button text-center">
                            <button type="submit" class="btn btn-primary" style="height: 46px;">Submit</button>
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
    @if(Auth::check())
        let isFavorited = element.style.color === 'red';
        let route = isFavorited ? 'favorite.add' : 'favorite.remove';

        fetch(route, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ crop_management_id: cropId })
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

function setCropName(cropManagementId) {
    document.getElementById('crop_management_id').value = cropManagementId;

}

// document.getElementById('inquiryForm').addEventListener('submit', function(event) {
//     event.preventDefault();
//     alert('Inquiry submitted for ' + document.getElementById('cropManagementId').value);
//     $('#inquiryModal').modal('hide');
// });



</script>
