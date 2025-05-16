<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="walletLabel{{ $row->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Wallet Transaction</h5>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered text-center">
                    <thead class="table-secondary">
                        <tr>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($row->walletTransactions as $transaction)
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
