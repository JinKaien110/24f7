@extends('layouts.admin.navigation')

@section('title', 'Order Management')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            @include('admin.partials.orders.actions.order_filter-manage-order')
            <div class="d-flex justify-content-end align-items-center ">
                <button type="button" class="btn btn-outline-secondary mr-3" data-bs-toggle="modal" data-bs-target="#filterModal">
                    <i class="bi bi-funnel-fill me-1"></i> Filters
                </button>
            </div>
 <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light">
            <tr>
                <th>#</th>
                <th>Transaction ID</th>
                <th>Buyer</th>
                <th>Product Name / Model</th>
                <th>Status</th>
                <th>Ordered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->transaction->id }}</td>
                    <td>{{ ucfirst($order->user->first_name) ?? 'Unknown' }}  {{ ucfirst($order->user->last_name) ?? 'Unknown' }}</td>
                    <td>{{ $order->product->name }} / {{ $order->product->model_name ?? '' }}</td>
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
                    <td class="position-relative" style="overflow: visible;">
                        @if (
                            ($order->status === 'delivered' || $order->status === 'complete') && $order->refund_status === 'requested' ||
                            $order->status === 'pending' ||
                            $order->status === 'shipped'
                        )
                            <div x-data="{ open: false }" class="position-relative d-inline-block">
                                <button x-on:click="open = !open" class="text-gray-600 hover:text-gray-900">
                                    <i class="fas fa-ellipsis-h text-xl"></i>
                                </button>
                    
                                <div 
                                x-show="open" 
                                @click.away="open = false"
                                x-transition 
                                class="position-absolute end-0 mt-2 bg-white shadow rounded border"
                                style="z-index: 999; width: 200px; white-space: nowrap;"
                            >
                            
                                    <div class="py-1">
                                        @if (($order->status === 'delivered' || $order->status === 'shipped') && $order->refund_status === 'requested')
                                            @include('admin.partials.orders.actions.order_approve-order')
                                            @include('admin.partials.orders.actions.order_reject-refund')
                                        @elseif ($order->status === 'pending')
                                            @include('admin.partials.orders.actions.order_ship-order')  
                                        @elseif ($order->status === 'shipped')
                                            @include('admin.partials.orders.actions.order_deliver-order')
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    
                    
                    
                    
                    
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
     <!-- Pagination -->
     <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
</div>
</div>
</div>
@endsection