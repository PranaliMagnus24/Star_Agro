@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(frontend/assets/img/testimonial/test-bg.jpg)">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ __('messages.Frequently Asked Question') }}</h2>
                        <div class="breadcrumb-wrap">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.index')}}">{{ __('messages.Home') }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ __('messages.Frequently Asked Question') }}</li>
                        </ol>
                    </nav>
                </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- <section id="work" class="pt-120 pb-90">
    <div class="container">
        <div class="portfolio"> -->
            <!-- <div class="row align-items-center mb-50 text-center">
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
            </div> -->

            {{-- FAQs Grid --}}
            <!-- <div class="row grid">
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
            </div>  -->

            
        <!-- </div>
    </div>
</section>  -->
<section id="faq" class="faq-area pt-110 pb-110">             
    <div class="container">   
        <div class="row">
        <div class="row align-items-center mb-50 text-center">
                <div class="col-lg-12">
                    <div class="my-masonry">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All FAQ</button>
                            

                             @foreach ($categories as $category)
                                @php
                                    $catClass = strtolower(str_replace(' ', '', $category->name));
                                @endphp
                                <button data-filter="{{ $catClass }}">{{ $category->name }}</button>
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>

            {{-- Left Column --}}
            <div class="col-lg-6 col-md-6">
                <div class="faq-wrap">
                    <div class="accordion" id="accordionLeft">
                        @foreach($faqs->take(ceil($faqs->count()/2)) as $index => $faq)
                            @php
                                $categoryClass = strtolower(str_replace(' ', '', $faq->category->name ?? 'general'));
                            @endphp
                            <div class="card grid-item {{ $categoryClass }}">
                                <div class="card-header" id="headingLeft{{ $index }}">
                                    <h2 class="mb-0">
                                        <button class="faq-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseLeft{{ $index }}" aria-expanded="false" aria-controls="collapseLeft{{ $index }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseLeft{{ $index }}" class="collapse" aria-labelledby="headingLeft{{ $index }}" data-parent="#accordionLeft">
                                    <div class="card-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="col-lg-6 col-md-6">
                <div class="faq-wrap">
                    <div class="accordion" id="accordionRight">
                        @foreach($faqs->slice(ceil($faqs->count()/2)) as $index => $faq)
                            @php
                                $categoryClass = strtolower(str_replace(' ', '', $faq->category->name ?? 'general'));
                                $rightIndex = $index + ceil($faqs->count()/2);
                            @endphp
                            <div class="card grid-item {{ $categoryClass }}">
                                <div class="card-header" id="headingRight{{ $rightIndex }}">
                                    <h2 class="mb-0">
                                        <button class="faq-btn collapsed" type="button" data-toggle="collapse" data-target="#collapseRight{{ $rightIndex }}" aria-expanded="false" aria-controls="collapseRight{{ $rightIndex }}">
                                            {{ $faq->question }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseRight{{ $rightIndex }}" class="collapse" aria-labelledby="headingRight{{ $rightIndex }}" data-parent="#accordionRight">
                                    <div class="card-body">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

<script>
    $(document).ready(function(){
        $('.button-group button').click(function(){
            var filterClass = $(this).attr('data-filter');
            if (filterClass === '*') {
                $('.grid-item').show();
            } else {
                $('.grid-item').hide();
                $('.' + filterClass).show();
            }
        });
    });
</script>
