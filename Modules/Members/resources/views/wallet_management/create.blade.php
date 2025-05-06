@extends('members::layouts.master')

@section('title', __('messages.Create Wallet'))
@section('pagetitle', __('messages.Create Wallet'))

@section('member')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('messages.Create New Wallet') }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('wallet.management.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="wallet_name">{{ __('messages.walletName') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('wallet_name') is-invalid @enderror"
                                   id="wallet_name" name="wallet_name" value="{{ old('wallet_name') }}" required>

                            @error('wallet_name')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="balance">{{ __('messages.balance') }} <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control @error('balance') is-invalid @enderror"
                                   id="balance" name="balance" value="{{ old('balance') }}" required>

                            @error('balance')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('wallet.management.index') }}" class="btn btn-secondary">{{ __('messages.Back') }}</a>
                            <button type="submit" class="btn btn-success">{{ __('messages.Save') }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
