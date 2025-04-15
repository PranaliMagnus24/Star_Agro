@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')

<section class="breadcrumb-area d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Frequently Asked Question') }}</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('home.faq') }}">{{ __('messages.FAQ') }}</a>
                                    </li>
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
        <div class="portfolio">
            <div class="row align-items-center mb-50 text-center">
                <div class="col-lg-12">
                    <div class="my-masonry">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All FAQ</button>
                            @foreach ($categories as $category)
                                @php
                                    $catClass = strtolower(str_replace(' ', '', $category->name));
                                @endphp
                                <button data-filter=".{{ $catClass }}">{{ $category->name }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- FAQs Grid --}}
            <div class="row grid">
                @foreach ($faqs as $faq)
                    @php
                        $categoryClass = strtolower(str_replace(' ', '', $faq->category->name ?? 'general'));
                    @endphp
                    <div class="col-lg-6 col-md-6 grid-item {{ $categoryClass }}">
                        <div class="faq-box mb-4 p-4 border rounded shadow-sm">
                            <h5 class="faq-question">{{ $faq->question }}</h5>
                            <p class="faq-answer">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            </div> 

            
        </div>
    </div>
</section>

@endsection