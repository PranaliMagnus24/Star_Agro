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
                        <form class="d-flex me-2" method="GET" action="{{ route('paymentGateway.list') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                        <a href="{{ route('paymentGateway.create') }}" class="btn btn-primary mb-3">+</a>
                    </div>
                </div>

                <div class="card-body mt-3">
                  <table class="table table-bordered table-striped">
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
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payments->firstItem() + $loop->index }}</td>
                            <td>{{ $payment->api_key }}</td>
                            <td>{{ $payment->secret_key}}</td>
                            <td>{{ ucfirst($payment->payment) }}</td>
                            <td>{{ ucfirst($payment->status) }}</td>
                            <td class="text-center text-nowrap">
                              <a href="{{ route('paymentGateway.edit', $payment->id)}}" class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a>
                              <form action="{{ route('paymentGateway.delete', $payment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this payment gateway?');">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>

                  </table>
                  <div class="d-flex justify-content-center">
                   {{$payments->links()}}
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
