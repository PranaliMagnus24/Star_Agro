@extends('admin.layouts.layout')

@section('title', 'Whatsapp')
@section('admin')
@section('pagetitle', __('messages.Whatsapp'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Whatsapp') }}</h4>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('whatsapp.create') }}" class="btn btn-primary mb-3">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped whatsappList">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Api key') }}</th>
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
    const whatsappUrl = "{{route('whatsapp.index') }}";
</script>

