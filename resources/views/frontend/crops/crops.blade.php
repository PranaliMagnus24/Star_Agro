@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
{{-- <section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
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

<!-- services-area -->
<section id="services2" class="services-area2 pb-90 fix p-relative crops">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-relative">
                <div class="section-title center-align mb-50 text-center">
                    <h5>{{ __('messages.Crops') }}</h5>
                    <h2>{{ __('messages.Crops Managements') }}</h2>
                </div>
            </div>
        </div>
        <!-- <div class="row mb-3">
            <div class="col-lg-8 col-sm-8 d-flex justify-content-end">
                <form method="GET" action="{{ route('home.crops') }}" class="d-flex align-items-center">
                    <input type="text" name="search" placeholder="{{__('messages.Search Crop..') }}" aria-label="Search categories" 
                    class="form-control category-search-input" value="{{ request()->query('search') }}" style="width:500px;">
                </form>
            </div>
        </div> -->
        <div class="row mb-3">
                <div class="col-lg-8 col-sm-8 d-flex justify-content-end">
                     <form id="search-form" method="GET" action="{{ route('home.crops') }}" class="d-flex align-items-center w-100 justify-content-end">
                        <div class="position-relative" style="width: 500px;">
                                 <!-- <input type="text" 
                                    name="search" 
                                    placeholder="{{ __('messages.Search Crop..') }}" 
                                    aria-label="Search categories" 
                                    class="form-control category-search-input pr-5" 
                                    value="{{ request()->query('search') }}"> -->

                                    <button type="submit" 
                                        class="position-absolute border-0 bg-transparent" 
                                        style="top: 50%; right: 10px; transform: translateY(-50%); color: #aaa;">
                                        <i class="fa fa-search"></i>
                                    </button>

                                     <!-- <div id="search-suggestions" class="list-group position-absolute w-100" style="z-index: 1000;"></div> -->
                                    <input type="text" id="crop-search" name="search" placeholder="Search Crops..." class="form-control" autocomplete="off"> 
                                    </div>
                     </form>
             </div>
        </div>

        <div class="row mt-5">
            @foreach($categories as $category)
                @if ($category->crop_managements_count > 0)
                    <div class="col-6 col-sm-4 col-md-2 mb-4">
                        <div class="card h-100 text-center">
                            <a href="{{ route('crop.management.list', $category->id) }}" style="text-decoration: none; color: inherit;">
                                @php
                                    $imagePath = $category->category_image && file_exists(public_path($category->category_image))
                                        ? asset($category->category_image)
                                        : asset('upload/dummy.jpg');
                                @endphp
                                <img src="{{ $imagePath }}" class="card-img-top" alt="{{ $category->category_name }}" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h6 class="card-title text-truncate">
                                        {{ $category->category_name }}
                                    </h6>
                                    <p class="text-white" style="background-color: #76bc02; font-size: 21px">
                                        {{ $category->crop_managements_count }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>



       
    </div>
    <div class="row">
        <div class="col-12">
            <div class="pagination-wrap mt-50 text-center">
                <nav>
                    <ul class="pagination">
                        @if ($categories->onFirstPage())
                        <li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-left"></i></a>
                        </li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $categories->previousPageUrl() }}"><i class="fas fa-angle-double-left"></i></a>
                        </li>
                        @endif
                        @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        @if ($page == $categories->currentPage())
                        <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
                        @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                        @endforeach
                        @if ($categories->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $categories->nextPageUrl() }}"><i class="fas fa-angle-double-right"></i></a></li>
                        @else
                        <li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-right"></i></a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
           
<script>
    $(function () {
        $("#crop-search").autocomplete({
            source: "{{ route('autosuggest.crops') }}",
            minLength: 2,
            select: function (event, ui) {
    $('#crop-search').val(ui.item.value);
    $('#search-form').submit(); // Make sure your input is inside a form with this ID
}
        });
    });
</script>


@endsection
