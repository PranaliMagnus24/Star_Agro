@extends('members::layouts.master')

@section('title', __('messages.Crop Management'))
@section('pagetitle', __('messages.Crop Management'))
@section('member')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            <!-- Search and Title -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Farmer Details</h3>
                <form class="d-flex" method="GET" action="#">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary" title="Search">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Inquiry List -->
            <div class="row">
                @foreach ($inquiries as $index => $inquiry)
                    <div class="col-md-4 mb-4"> <!-- Each farmer takes up 1/3 of the row -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                            <div class="card-header bg-primary text-white">
                        Farmer Details For: {{ $inquiry->cropManagement->crop_name ?? 'N/A' }}
                    </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Name:</th>
                                            <td>{{ $inquiry->cropManagement->farmer->name ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile:
                                                 Email:
                                            </th>
                                            <td>{{ $inquiry->cropManagement->farmer->phone ?? 'N/A' }}
                                            {{ $inquiry->cropManagement->farmer->email ?? 'N/A' }}
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <th></th>
                                            <td>{{ $inquiry->cropManagement->farmer->email ?? 'N/A' }}</td>
                                        </tr> -->
                                        <tr>
                                            <th>City:</th>
                                            <td>
                                                {{ $states[$inquiry->cropManagement->farmer->state] ?? 'Maharashtra' }} &nbsp; 
                                                {{ $districts[$inquiry->cropManagement->farmer->district] ?? 'Nashik' }} &nbsp; 
                                                {{ $inquiry->cropManagement->farmer->town ?? 'Unknown Town' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Date:</th>
                                            <td>{{ \Carbon\Carbon::parse($inquiry->created_at)->format('d M Y') }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                @if ($inquiry->walletTransactions->count())
                                    <h6 class="mt-3">Wallet Transactions:</h6>
                                    <table class="table table-sm table-bordered">
                                        <thead class="table-secondary">
                                            <tr>
                                                <th>Type</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inquiry->walletTransactions as $transaction)
                                                <tr>
                                                    <td>{{ ucfirst($transaction->type) }}</td>
                                                    <td>{{ $transaction->amount }}</td>
                                                    <td>{{ $transaction->description }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-muted">No wallet transactions available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if (($index + 1) % 3 == 0) <!-- Close the row after every three farmers -->
                        </div>
                        <div class="row">
                    @endif
                @endforeach
            </div>

        </div>
    </div>

    <!-- Filtered Transactions for Logged-in User -->
    <!-- <div class="mt-5">
        <h3>Wallet Transaction Details</h3>
        @php $hasWalletTransactions = false; @endphp

        @foreach ($inquiries as $inquiry)
            @if (auth()->check() && $inquiry->email == auth()->user()->email && $inquiry->walletTransactions->count())
                @php $hasWalletTransactions = true; @endphp
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        Transactions for Inquiry: {{ $inquiry->cropManagement->crop_name ?? 'N/A' }}
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inquiry->walletTransactions as $transaction)
                                    <tr>
                                        <td>{{ ucfirst($transaction->type) }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach

        @if (!$hasWalletTransactions)
            <p class="text-muted">No wallet transactions available for your account.</p>
        @endif
    </div> -->
</div>

@endsection