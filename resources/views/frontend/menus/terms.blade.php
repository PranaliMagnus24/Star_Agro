@extends('frontend.layouts.layout')

@section('title', $page->meta_title ?? $page->title ?? 'Star Agro')

@section('meta')
    <meta name="keywords" content="{{ $page->meta_keyword }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta property="og:title" content="{{ $page->og_title }}">
    <meta property="og:description" content="{{ $page->og_description }}">
    @if($page->og_img)
        <meta property="og:image" content="{{ asset('uploads/pages/'.$page->og_img) }}">
    @endif
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-editor ol[data-list='bullet'] {
            list-style-type: disc;
            padding-left: 1.5rem;
        }
        .ql-editor ol[data-list='ordered'] {
            list-style-type: decimal;
            padding-left: 1.5rem;
        }
        .ql-editor h2, .ql-editor h3 {
            font-weight: 600;
            margin-top: 1.2rem;
            margin-bottom: 0.75rem;
        }
        .ql-editor p {
            margin-bottom: 0.8rem;
            line-height: 1.6;
        }
    </style>
@endsection

@section('content')
<section class="breadcrumb-area d-flex align-items-center" style="background-image:url('{{ asset('frontend/assets/img/testimonial/test-bg.jpg') }}')">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="breadcrumb-wrap text-left">
                    <div class="breadcrumb-title">
                        <h2>{{ $page->title }}</h2>
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('messages.Home') }}</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
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
        <div class="portfolio">
            <div class="row justify-content-center mb-50">
                <div class="col-lg-10">
                    @if($page->image)
                        <img src="{{ asset('uploads/pages/'.$page->image) }}" alt="{{ $page->title }}" class="img-fluid mb-4 rounded shadow-sm">
                    @endif

                    {{-- Description --}}
                    <div class="my-masonry ql-editor bg-white p-4 rounded shadow-sm">
                        {!! preg_replace('/<p><br><\/p>/', '', $page->description) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section id="work" class="pt-100 pb-70" style="background-color: #f4f7fe;">
    <div class="container">
        <div class="portfolio">
            <div class="row justify-content-center mb-50">
                <div class="col-lg-10" >
                    @if($page->image)
                        <img src="{{ asset('uploads/pages/'.$page->image) }}" alt="{{ $page->title }}" class="img-fluid mb-4 rounded shadow-sm">
                    @endif

                    {{-- Description --}}
                    <div class="my-masonry ql-editor bg-white p-4 rounded shadow-sm">
                        {!! preg_replace('/<p><br><\/p>/', '', $page->description) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
