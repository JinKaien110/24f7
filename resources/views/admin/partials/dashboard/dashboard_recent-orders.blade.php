<div class="mb-6">
    <div class="mt-5">
        <h4>Recent Orders</h4>
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Product Purchased</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ ucfirst($order->user->first_name) }} {{ ucfirst($order->user->last_name) }}</td>
                            <td>{{ $order->product->name }}</td> <!-- Accessing the product name -->
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
                            
                        </tr>
                        @endforeach
                    </tbody>
                          <tfoot>
            <tr>
                <td colspan="4" class="text-end"><strong>Total Subtotal Sales:</strong></td>
                <td colspan="2"><strong>₱{{ number_format($totalRecentSubtotal, 2) }}</strong></td>
                
            </tr>
        </tfoot>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
