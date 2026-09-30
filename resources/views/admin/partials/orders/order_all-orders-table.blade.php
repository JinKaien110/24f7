 <!-- Table -->
 <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>Transaction ID</th>
                <th>Name</th>
                <th>Product Name / Model</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->transaction->id }}</td>
                    <td>{{ ucfirst($order->user->first_name) ?? 'Unknown' }}  {{ ucfirst($order->user->last_name) ?? 'Unknown' }}</td>
                    <td>{{ $order->product->name }} / {{ $order->product->model_name ?? '' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>₱{{ number_format($order->subtotal ?? 0, 2) }}</td>
                    <td>
                        @if ($order->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                    
                        @elseif ($order->status == 'complete' && $order->refund_status === 'none')
                            <span class="badge bg-success">Complete</span>

                        @elseif ($order->refund_status === 'rejected')
                            <span class="badge bg-success">Refund: Rejected</span>
                    
                        @elseif ($order->status == 'complete' && $order->refund_status === 'cancelled')
                            <span class="badge bg-success">Complete</span>
                    
                        @elseif (($order->status == 'shipped' || $order->status == 'delivered') && $order->refund_status === 'requested')
                            <span class="badge bg-info">Refund: Requested</span>
                    
                        @elseif ($order->status == 'delivered' && $order->refund_status === 'none')
                            <span class="badge bg-success">Delivered</span>
                    
                        @elseif ($order->status == 'shipped')
                            <span class="badge bg-danger">Shipped</span>
                    
                        @elseif ($order->status == 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                    
                        @elseif ($order->status == 'refunded')
                            <span class="badge bg-secondary">Refunded</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('F j, Y - g:i A') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-end"><strong>Total Subtotal Sales:</strong></td>
                <td colspan="5"><strong>₱{{ number_format($totalSubSales, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
     <!-- Pagination -->
     <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>