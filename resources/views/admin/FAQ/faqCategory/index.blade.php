@extends('admin.layouts.layout')

@section('title', 'FaqCategory')
@section('admin')
@section('pagetitle', __('messages.FaqCategory'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.FaqCategory') }}</h4>
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="{{ route('admin.faqCategory')}}">
                            <div class="input-group">                  
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        <a href="{{route('admin.faqCategory.create')}}" class="btn btn-primary btn-sm">+</a>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ __('messages.FAQCategoryName') }}</th>
                                <th>{{ __('messages.Description') }}</th>
                                <th>{{ __('messages.Status') }}</th>
                                <th class="no-wrap">{{ __('messages.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $counter = ($categories->currentPage() - 1) * $categories->perPage() + 1;
                        @endphp
                            @foreach($categories as $category)
                            <tr>
                                 <td>{{ $counter++ }}</td>
                                <td>{{ ucfirst($category->name) }}</td>
                                <td>{{ $category->description }}</td>
                                <td>{{ ucfirst($category->status) }}</td>
                                <td class="text-center text-nowrap">
                                    <a href="{{ route('admin.faq.faqCategory.edit', $category->id) }}" class="btn btn-success btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.faq.faqCategory.delete', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $categories->links() }} <!-- Update pagination variable -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>