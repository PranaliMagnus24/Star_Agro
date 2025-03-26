@extends('admin.layouts.layout')

@section('title', 'Category')
@section('admin')
@section('pagetitle', __('messages.Category'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Category') }}</h4>
                    <div class="d-flex align-items-center">
                        <form class="d-flex me-2" method="GET" action="{{ route('category.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        @can('create category')
                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">+</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Description') }}</th>
                            <th>{{ __('messages.Status') }}</th>
                            <th class="no-wrap">{{ __('messages.Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $categories->firstItem() + $loop->index }}</td>
                            <td>{{ ucfirst($category->category_name) }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ ucfirst($category->status) }}</td>
                            <td class="text-center text-nowrap">
                                @can('update category')
                              <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                              @endcan
                              @can('delete category')
                              <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger btn-sm"><i class="bi bi-trash3-fill"></i></a>
                              @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                  <div class="d-flex justify-content-center">
                   {{ $categories->links() }}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
