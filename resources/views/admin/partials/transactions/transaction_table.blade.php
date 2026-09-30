<div class="table-responsive">
    <table class="table table-hover">
        <thead class="bg-light">
            <tr>
                <th>Transaction ID</th>
                <th>User</th>
                <th>Amount Paid</th>
                <th>Change</th>
                <th>Vat Amount</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->id }}</td>
                    <td>{{ ucfirst($transaction->user->first_name) }} {{ ucfirst($transaction->user->last_name) }}</th>
                    <td>₱{{ number_format($transaction->amount_paid, 2) }}</td>
                    <td>₱{{ number_format($transaction->change, 2) }}</td>
                    <td>₱{{ number_format($transaction->vat_amount, 2) }}</td>
                    <td>₱{{ number_format($transaction->total_amount, 2) }}</td>
                    <td class="text-capitalize">{{ $transaction->payment_method }}</td>
                    <td>{{ $transaction->created_at->format('F j, Y - g:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1" class="text-start text-muted">Note: VAT Amount is 12%</td>
                <td colspan="3" class="text-end"><strong>Total Sales:</strong></td>
                <td colspan="5"><strong>₱{{ number_format($totalSales, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-4">
    {{ $transactions->links() }}
</div>