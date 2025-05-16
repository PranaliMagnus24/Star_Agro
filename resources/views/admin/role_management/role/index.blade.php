@extends('admin.layouts.layout')

@section('title', 'Roles')
@section('admin')
@section('pagetitle', __('messages.Role'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Roles') }}</h4>
                    <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">+</a>
                </div>
                <div class="card-body mt-3">
                    {{-- @livewire('permission-table') --}}
                  <table class="table table-bordered table-striped roleList">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Action') }}</th>
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
    const roleUrl = "{{ route('role.list') }}";
</script>
