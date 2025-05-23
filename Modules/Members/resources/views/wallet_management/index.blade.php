@extends('members::layouts.master')

@section('title', __('messages.Wallet'))
@section('pagetitle', __('messages.Wallet'))

@section('member')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
        

                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        
                         <br>
                         <a href="{{ route('razorpay.index') }}" class="btn btn-success">Recharge</a> 

                    </div>
                </div>

                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped walletList">
                        <thead>
                            <tr>
                                <th>{{ __('messages.ID') }}</th>
                                <th>{{ __('messages.walletName') }}</th>
                                <th>{{ __('messages.balance') }}</th>
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
    const walletUrl="{{ route('wallet.management.index') }}";
</script>

