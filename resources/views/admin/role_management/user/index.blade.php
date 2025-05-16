@extends('admin.layouts.layout')

@section('title', 'Users')
@section('admin')
@section('pagetitle', __('messages.User'))
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.User') }}</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">+</a>
                </div>
                <div class="card-body mt-3">
                    {{-- @livewire('permission-table') --}}
                  <table class="table table-bordered table-striped userlist">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Name') }}</th>
                            <th>{{ __('messages.Email') }}</th>
                            <th>{{ __('messages.Roles') }}</th>
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
      const userUrl = "{{ route('users.list') }}";
</script>
