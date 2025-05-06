@extends('frontend.layouts.layout')
@section('title', 'Star Agro')
@section('content')
<section id="blog" class="blog-area  p-relative pt-120 pb-70 fix crops">
    <!-- Farmer Details Section -->
    <div class="container py-4">

        <h3 class="mb-3">Farmer Details</h3>

        @if ($cropManagement->inquiries && $cropManagement->inquiries->count())
            @php $inquiryShown = false; @endphp

            @foreach ($cropManagement->inquiries as $inquiry)
                @if (auth()->check() && $inquiry->email == auth()->user()->email)
                    @php $inquiryShown = true; @endphp

                    <div class="mb-4 border p-3 rounded shadow-sm">
                        <h5>Farmer: {{ $inquiry->name }}</h5>
                        <p><strong>Mobile:</strong> {{ $inquiry->mobile_number }}</p>
                        <p><strong>Email:</strong> {{ $inquiry->email }}</p>
                        <p><strong>City:</strong> {{ $inquiry->city }}</p>
                        <p><strong>Description:</strong> {{ $inquiry->description }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($inquiry->created_at)->format('d M Y') }}</p>

                        @if ($inquiry->walletTransactions && $inquiry->walletTransactions->count())
                            <div class="mt-3">
                                <h6>Wallet Transactions:</h6>
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
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-muted">No wallet transactions available.</p>
                        @endif
                    </div>
                @endif
            @endforeach

            @if (!$inquiryShown)
                <p>No inquiries available for your account.</p>
            @endif
        @else
            <p>No inquiries available.</p>
        @endif
    </div>


    <!-- Transaction Section -->
    <div class="container py-4">
        <h3 class="mt-4">Wallet Transaction Details</h3>

        @php $hasWalletTransactions = false; @endphp

        @foreach ($cropManagement->inquiries as $inquiry)
            @if (auth()->check() && $inquiry->email == auth()->user()->email && $inquiry->walletTransactions->count())
                @php $hasWalletTransactions = true; @endphp
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        Transactions for Inquiry: {{ $inquiry->name }}
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
            <p>No wallet transactions available for your account.</p>
        @endif

    </div>

@endsection