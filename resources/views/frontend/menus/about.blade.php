@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.About Us') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.About Us') }}</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@include('frontend.partials.about')
@include('frontend.partials.team_area')

@endsection
