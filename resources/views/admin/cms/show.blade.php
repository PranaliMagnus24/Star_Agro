@extends('admin.layouts.layout')

@section('title', 'Show CMS Page')
@section('admin')
@section('pagetitle', __('messages.Show CMS Page'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-2">
            
    <h4 class="mb-0">CMS Page details</h4>
    <a href="{{ route('pages.index') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-skip-backward-fill"></i> 
    </a>
</div>
            </div>

                <div class="card-body">
                    <h5>Title: {{ $page->title }}</h5>
                    <p><strong>Slug:</strong> {{ $page->slug }}</p>
                    <p><strong>Summary:</strong> {{ $page->summary }}</p>
                    <p><strong>Description:</strong> {!! $page->description !!}</p>
                    @if($page->image)
                        <div class="mb-2">
                            <img src="{{ asset('upload/pages/' . $page->image) }}" alt="Image" style="width: 100px; height: auto; border-radius: 5px;">
                        </div>
                    @endif
                    <p><strong>Meta Title:</strong> {{ $page->meta_title }}</p>
                    <p><strong>Meta Keyword:</strong> {{ $page->meta_keyword }}</p>
                    <p><strong>Meta Description:</strong> {{ $page->meta_description }}</p>
                    <p><strong>OG Title:</strong> {{ $page->og_title }}</p>
                    <p><strong>OG Description:</strong> {{ $page->og_description }}</p>
                    @if($page->og_img)
                        <div class="mb-2">
                            <img src="{{ asset('upload/pages/' . $page->og_img) }}" alt="OG Image" style="width: 100px; height: auto; border-radius: 5px;">
                        </div>
                    @endif
                    <p><strong>Status:</strong> {{ $page->status }}</p>
                    <!-- <a href="{{ route('pages.index') }}" class="btn btn-primary">Back to List</a> -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection