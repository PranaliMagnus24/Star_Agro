@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Gallery') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Gallery') }}</li>
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
        <div class="portfolio ">
            <div class="row align-items-center mb-50 text-center">
                <div class="col-lg-12">
                     <div class="my-masonry">
                <div class="button-group filter-button-group ">
                   <button class="active" data-filter="*">All Gallery</button>
                     <button data-filter=".seo">Kitchen </button>
                    <button data-filter=".marketing">Office cleaning</button>
                    <button data-filter=".website">Car Cleaning</button>

                </div>
            </div>
                </div>
            </div>


    <div class="grid col2">

           <div class="grid-item website">
            <div class="box20  p-relative fix">
            <img src="{{ asset('frontend/assets/img/gallery/car.jpg') }}" alt="protfolio">
            <div class="box-content">
                <h3 class="title"><a href="projects-detail.html">Car Cleaning</a></h3>

            </div>
            <ul class="icon">

                <li><a href="projects-detail.html"><i class="fa fa-link"></i></a></li>
            </ul>
        </div>

        </div>
        <div class="grid-item seo">
             <div class="box20  p-relative fix">
            <img src="{{ asset('frontend/assets/img/gallery/kitchen.jpg') }}" alt="protfolio">
            <div class="box-content">
                <h3 class="title"><a href="projects-detail.html">Kitchen Cleaning</a></h3>
            </div>
            <ul class="icon">

                <li><a href="projects-detail.html"><i class="fa fa-link"></i></a></li>
            </ul>
        </div>
        </div>
         <div class="grid-item marketing">
               <div class="box20  p-relative fix">
            <img src="{{ asset('frontend/assets/img/gallery/officecleaning.jpg') }}" alt="protfolio">
            <div class="box-content">
                <h3 class="title"><a href="projects-detail.html">Office Cleaning</a></h3>
            </div>
            <ul class="icon">

                <li><a href="projects-detail.html"><i class="fa fa-link"></i></a></li>
            </ul>
        </div>

        </div>
             <div class="grid-item website">
            <div class="box20  p-relative fix">
            <img src="{{ asset('frontend/assets/img/gallery/protfolio-img06.png') }}" alt="protfolio">
            <div class="box-content">
                <h3 class="title"><a href="projects-detail.html">Car Cleaning</a></h3>
            </div>
            <ul class="icon">

                <li><a href="projects-detail.html"><i class="fa fa-link"></i></a></li>
            </ul>
        </div>

        </div>
        <div class="grid-item seo">
             <div class="box20  p-relative fix">
            <img src="{{ asset('frontend/assets/img/gallery/protfolio-img05.png') }}" alt="protfolio">
            <div class="box-content">
                <h3 class="title"><a href="projects-detail.html">Kitchen Cleaning</a></h3>
            </div>
            <ul class="icon">

                <li><a href="projects-detail.html"><i class="fa fa-link"></i></a></li>
            </ul>
        </div>
        </div>
         <div class="grid-item marketing">
               <div class="box20  p-relative fix">
            <img src="{{ asset('frontend/assets/img/gallery/protfolio-img04.png') }}" alt="protfolio">
            <div class="box-content">
                <h3 class="title"><a href="projects-detail.html">Office Cleaning</a></h3>
            </div>
            <ul class="icon">

                <li><a href="projects-detail.html"><i class="fa fa-link"></i></a></li>
            </ul>
        </div>

        </div>


        </div>

</div>
    </div>
</section>

@endsection
