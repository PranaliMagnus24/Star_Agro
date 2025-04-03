@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
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
<!-- services-area -->
<section id="services2" class="services-area2 pt-120 pb-90 fix p-relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-relative">
                <div class="section-title center-align mb-50 text-center">
                    <h5>{{ __('messages.Crops') }}</h5>
                    <h2>{{ __('messages.Crops Managements') }}</h2>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6 col-sm-6">

            </div>
            <div class="col-lg-6 col-sm-6 text-right">
                <form method="GET" action="{{ route('home.crops') }}" class="d-flex align-items-center">
                    <input type="text" name="search" placeholder="Search categories..." aria-label="Search categories" class="form-control category-search-input" value="{{ request()->query('search') }}">
                    <select name="orderby" class="orderby form-control" aria-label="Shop order">
                        <option value="menu_order" selected="selected">Default sorting</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by latest</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($categories as $category)
                @if ($category->crop_managements_count > 0)
                    <div class="col-6 col-md-4 col-lg-2 mb-2">
                        <div class="item">
                            <a href="{{ route('crop.management.list', $category->id) }}">
                                <div class="category-card">
                                    <div class="pos1">
                                        <div class="circle-badge">
                                            {{ $category->crop_managements_count }}
                                        </div>
                                        <div class="abv abv1">{{ $category->category_name }}</div>
                                    </div>
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
            <!-- services-area-end -->
            {{-- <section id="graph" class="features-area pt-70 pb-50"  style="background:url('frontend/assets/img/bg/shop-bg.png');">
                <div class="container">

                    <div class="row align-items-center">
                         <div class="col-lg-5 col-md-12">
                            <img src="{{ asset('frontend/assets/img/bg/features-lg-img.png') }}" alt="features-lg-img">
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="section-title cta-title  mb-20">


                                <h2>Your Happines Guarante</h2>
                            </div>
                            <p>Phasellus ligula diam, rhoncus a tincidunt in, auctor non est. Nulla eleifend est non nibh sodales, ut hendrerit nisi egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent condimentum, eros feugiat tincidunt bibendum, urna libero ullamcorper diam, quis interdum nulla nunc sed ipsum.</p>

                        </div>




                    </div>

                </div>
            </section> --}}
{{-- @include('frontend.partials.testimonial') --}}

@endsection
