@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" >
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Frequently Asked Questions') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.faq') }}">{{ __('messages.FAQ') }}</a></li>
                            <!-- <li class="breadcrumb-item active" aria-current="page">{{ __('messages.FAQ') }}</li> -->
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
                   <button class="active" data-filter="*">All FAQ</button>
                     <button data-filter=".general">General FAQs</button>
                    <button data-filter=".farmer">Farmer FAQs</button>
                    <button data-filter=".product">Product FAQs</button>
                    <button data-filter=".ordering">Ordering and Payment FAQs</button> 
                    <button data-filter=".shipping">Shipping and Delivery FAQs</button> 

                    

                </div>
            </div>
                </div>
            </div>


   
    </div>
</section>

@endsection
