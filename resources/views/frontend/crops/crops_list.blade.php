@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
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
                        Letest News & Blog
                    </h2>


                </div>

            </div>
        </div>
        <div class="row blog-nth">
            @foreach($cropManagements as $cropManagement)
            <div class="col-lg-4 col-md-6">
                <div class="single-post2 mb-30  wow fadeInDown  animated">
                    <div class="blog-thumb2">
                        <a href="blog-details.html"><img src="{{ asset('frontend/assets/img/blog/inner_b1.jpg') }}" alt="img"></a>

                    </div>
                    <div class="blog-content2">


                         <div class="row">
                            <div class="col-lg-12">
                             <h4><a href="blog-details.html">{{ $cropManagement->crop_name }}</a></h4>
                            </div>
                        </div>
                         <div class="b-meta">
                            <div class="row">
                                 <div class="col-lg-12 col-md-12">
                                 <div class="meta-info">
                                    <ul>
                                        <li><i class="fal fa-user"></i> Admin</li>
                                        <li><i class="fal fa-calendar-alt"></i> 24th March 2021</li>

                                    </ul>
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
</section>
<!-- blog-area-end -->
@endsection
