@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Services') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Services') }}</li>
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
                                 <h5>Services</h5>
                                <h2>
                                    Professional Care And Services
                                </h2>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                          <div class="services-box2 mb-30">
                              <div class="services-icon">
                                   <img src="{{ asset('frontend/assets/img/icon/se-icon1.png') }}" alt="icon01">
                                </div>
                               <div class="services-content2">
                                   <h5><a href="services-detail.html">Vegetable Care</a></h5>
                                    <p>Integer placerat sapien enim, at aliquet sem molestie nonulla tristique commodo augue at incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="services-box2 mb-30">
                              <div class="services-icon">
                                   <img src="{{ asset('frontend/assets/img/icon/se-icon2.png') }}" alt="icon01">
                                </div>
                               <div class="services-content2">
                                   <h5><a href="services-detail.html">Fresh Food</a></h5>
                                    <p>Integer placerat sapien enim, at aliquet sem molestie nonulla tristique commodo augue at incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>
                       <div class="col-lg-4 col-md-6">
                          <div class="services-box2 mb-30">
                              <div class="services-icon">
                                   <img src="{{ asset('frontend/assets/img/icon/se-icon3.png') }}" alt="icon01">
                                </div>
                               <div class="services-content2">
                                    <h5><a href="services-detail.html">Securty & Safety</a></h5>
                                    <p>Integer placerat sapien enim, at aliquet sem molestie nonulla tristique commodo augue at incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="services-box2 mb-30">
                              <div class="services-icon">
                                   <img src="{{ asset('frontend/assets/img/icon/se-icon2.png') }}" alt="icon01">
                                </div>
                               <div class="services-content2">
                                   <h5><a href="services-detail.html">Fresh Food</a></h5>
                                    <p>Integer placerat sapien enim, at aliquet sem molestie nonulla tristique commodo augue at incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                          <div class="services-box2 mb-30">
                              <div class="services-icon">
                                   <img src="{{ asset('frontend/assets/img/icon/se-icon4.png') }}" alt="icon01">
                                </div>
                               <div class="services-content2">
                                    <h5><a href="services-detail.html">Organic Products</a></h5>
                                    <p>Integer placerat sapien enim, at aliquet sem molestie nonulla tristique commodo augue at incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>
                       <div class="col-lg-4 col-md-6">
                          <div class="services-box2 mb-30">
                              <div class="services-icon">
                                   <img src="{{ asset('frontend/assets/img/icon/se-icon5.png') }}" alt="icon01">
                                </div>
                               <div class="services-content2">
                                    <h5><a href="services-detail.html">24X7 Support</a></h5>
                                     <p>Integer placerat sapien enim, at aliquet sem molestie nonulla tristique commodo augue at incididunt ut labore et dolore.</p>
                                </div>
                            </div>
                        </div>


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
