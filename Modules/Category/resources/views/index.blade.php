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
                       
                        @can('create category')
                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm">+</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped categorylist">
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
                       
                    </tbody>
                  </table>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
<script>
    const catergoryUrl = "{{route('category.index') }}";
</script>


