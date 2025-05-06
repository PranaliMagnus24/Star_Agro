@extends('admin.layouts.layout')

@section('title', 'Wallet')
@section('admin')
@section('pagetitle', __('messages.Wallet'))

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ __('messages.Wallet Transactions') }}</h4>
                    <form class="d-flex" method="GET" action="{{ route('admin.wallet.index') }}">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary" title="Search">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <a href="{{ route('admin.wallet.create') }}" class="btn btn-primary btn-sm">+</a>
                </div>

                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>UUID</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Confirmed</th>
                                <th>Meta</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->uuid }}</td>
                                <td>{{ ucfirst($transaction->type) }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->confirmed ? 'Yes' : 'No' }}</td>
                                <td><pre>{{ json_encode($transaction->meta, JSON_PRETTY_PRINT) }}</pre></td>
                                <td>{{ $transaction->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $transaction->updated_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
