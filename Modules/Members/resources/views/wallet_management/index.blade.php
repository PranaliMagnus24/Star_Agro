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
                        <form class="d-flex me-5" method="GET" action="#">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary" title="Search">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                        <!-- <a href="{{ route('wallet.management.create') }}" class="btn btn-primary">+</a> -->
                         <br>
                         <a href="{{ route('razorpay.index') }}" class="btn btn-success">Recharge</a> 

                    </div>
                </div>

                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('messages.ID') }}</th>
                                <th>{{ __('messages.walletName') }}</th>
                                <th>{{ __('messages.balance') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = ($wallets->currentPage() - 1) * $wallets->perPage() + 1;
                            @endphp

                            @forelse ($wallets as $wallet)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $wallet->wallet_name }}</td>
                                    <td>{{ $wallet->balance }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No wallets found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Laravel Pagination Links --}}
                    <div class="d-flex justify-content-center">
                        {{ $wallets->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
