@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
            <!-- slider-area -->
            @include('frontend.partials.slider')
            <!-- slider-area-end -->

            <!-- about-area -->
           @include('frontend.partials.about')
            <!-- about-area-end -->

             <!-- services-area -->
             @include('frontend.partials.services')
            <!-- services-area-end -->

              <!-- about-area -->
              <!-- @include('frontend.partials.watch_us') -->
            <!-- about-area-end -->

              <!-- editor-choice -->
              <!-- @include('frontend.partials.case_study') -->
            <!-- case-study-end -->

             <!-- testimonial-area -->
             <!-- @include('frontend.partials.testimonial') -->
            <!-- testimonial-area-end -->


             <!-- team-area -->
             @include('frontend.partials.team_area') 

             <!-- featured_area -->
              
            <!-- team-area-end -->
              <!-- blog-area -->
              <!-- @include('frontend.partials.blog') -->
            <!-- blog-area-end -->
@endsection
