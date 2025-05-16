@extends('admin.layouts.layout')

@section('title', 'Payment Gateway')
@section('admin')
@section('pagetitle', __('messages.Payment Gateway'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Payment Gateway') }}</h4>
                    <div class="d-flex align-items-center">
                        <!-- <form class="d-flex me-2" method="GET" action="{{ route('paymentGateway.list') }}">
                        </form> -->
                        <a href="{{ route('paymentGateway.create') }}" class="btn btn-primary mb-3">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped paymentgatewaylist">
                    <thead>
                        <tr>
                            <th>{{ __('messages.ID') }}</th>
                            <th>{{ __('messages.Api key') }}</th>
                            <th>{{ __('messages.Secret key') }}</th>
                            <th>{{ __('messages.Payment Method') }}</th>
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
    const paymentgatewayUrl = "{{route('paymentGateway.list') }}";
</script>

