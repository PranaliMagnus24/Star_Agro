@extends('admin.layouts.layout')

@section('title', 'Payment Gateway')
@section('admin')
@section('pagetitle', __('messages.Payment Gateway'))
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ isset($payment) ? __('messages.Edit') : __('messages.Add') }}</h4>
                    <a href="{{ route('paymentGateway.list')}}" class="btn btn-primary btn-sm"><i class="bi bi-skip-backward-fill"></i></a>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ isset($payment) ? route('paymentGateway.update', $payment->id) : route('paymentGateway.store') }}" method="POST">
                        @csrf
                        @if(isset($payment))
                            @method('PUT')
                        @endif
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Api Key</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="api_key" id="api_key" class="form-control" value="{{ isset($payment) ? $payment->api_key : '' }}">
                            </div>
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Secret Key</label>
                            <div class="col-md-8 col-lg-3">
                                <input type="text" name="secret_key" id="secret_key" class="form-control" value="{{ isset($payment) ? $payment->secret_key : '' }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Payment Options</label>
                            <div class="col-md-8 col-lg-3">
                               <select name="payment" id="payment_options" class="form-control">
                                <option value="">-- Select Payment Options --</option>
                                <option value="paypal" {{ (isset($payment) && $payment->payment == 'paypal') ? 'selected' : '' }}>Paypal</option>
                                <option value="stripe" {{ (isset($payment) && $payment->payment == 'stripe') ? 'selected' : '' }}>Stripe</option>
                                <option value="paytm" {{ (isset($payment) && $payment->payment == 'paytm') ? 'selected' : '' }}>Paytm</option>
                                <option value="razorpay" {{ (isset($payment) && $payment->payment == 'razorpay') ? 'selected' : 'selected' }}>Razorpay</option>
                                <option value="instamojo" {{ (isset($payment) && $payment->payment == 'instamojo') ? 'selected' : '' }}>Instamojo</option>
                                <option value="paystack" {{ (isset($payment) && $payment->payment == 'paystack') ? 'selected' : '' }}>Paystack</option>
                                <option value="flutterwave" {{ (isset($payment) && $payment->payment == 'flutterwave') ? 'selected' : '' }}>Flutterwave</option>
                                <option value="mobile payment" {{ (isset($payment) && $payment->payment == 'mobile payment') ? 'selected' : '' }}>Mobile Payment</option>
                               </select>
                            </div>
                            <label for="" class="col-md-4 col-lg-3 col-form-label">Status</label>
                            <div class="col-md-8 col-lg-3">
                               <select name="status" id="status" class="form-control">
                                <option value="active" {{ (isset($payment) && $payment->status == 'active') ? 'selected' : 'selected' }}>Active</option>
                                <option value="inactive" {{ (isset($payment) && $payment->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                               </select>
                            </div>
                        </div>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary btn-sm">{{ isset($payment) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

