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
             <section id="services2" class="services-area2 pt-120 pb-90 fix p-relative" >

                <div class="container">

                    <div class="row">
                        <div class="col-lg-12 p-relative">
                            <div class="section-title center-align mb-50 text-center">
                                 <h5>{{ __('messages.Crops') }}</h5>
                                <h2>
                                    {{ __('messages.Crops Managements') }}
                                </h2>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        @foreach ($categories as $category)
    <div class="col-lg-4 col-md-6">
        <div class="services-box2 mb-30">
            <div class="services-icon">
                <img src="{{ asset('frontend/assets/img/icon/se-icon1.png') }}" alt="icon01">
            </div>
            <div class="services-content2">
                <h5><a href="services-detail.html">{{ $category->category_name }}</a></h5>
                <p>#</p>
            </div>
        </div>
    </div>
@endforeach




                    </div>
                </div>
            </section>
            <!-- services-area-end -->
            <section id="graph" class="features-area pt-70 pb-50"  style="background:url('frontend/assets/img/bg/shop-bg.png');">
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
            </section>
@include('frontend.partials.testimonial')

@endsection
