@extends('layouts.user.layout')

@section('title', 'Products')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 pt-[130px]">
    <h2 class="text-2xl font-bold mb-6">My Orders</h2>

    <div class="bg-white shadow-lg rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Order ID</th>
                    <th class="px-4 py-3">Product</th>
                    <th class="px-4 py-3">Qty</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3">Subtotal</th>
                    <th class="px-4 py-3">Payment</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $order->id }}</td>
                        <td class="px-4 py-3 flex items-center space-x-2">
                            @if ($order->product?->image)
                                <img src="{{ asset('storage/' . $order->product->image) }}" 
                                    alt="{{ $order->product->name }}" 
                                    class="w-10 h-10 object-cover rounded" />
                            @endif
                            <span>{{ $order->product->name ?? 'N/A' }}</span>
                        </td>
                        
                        <td class="px-4 py-3">{{ $order->quantity }}</td>
                        <td class="px-4 py-3">₱{{ number_format($order->price, 2) }}</td>
                        <td class="px-4 py-3 font-semibold text-green-600">₱{{ number_format($order->subtotal, 2) }}</td>
                        <td class="px-4 py-3 capitalize">{{ $order->transaction->payment_method ?? 'N/A' }}</td>
                        <td class="px-4 py-3">
                            @php
                                // Default values
                                $refundStatus = null;
                                $refundStatusColor = 'gray';  // Default color for refund status
                                $statusColor = 'gray';        // Default color for order status
                                $backgroundColor = '#d1d5db'; // Default gray background color
                                $textColor = '#4b5563';       // Default gray text color
                        
                                // Set refund status and color based on the refund_status field
                                if ($order->refund_status === 'requested') {
                                    $refundStatus = 'Refund Requested';
                                    $backgroundColor = '#3b82f6';  // Blue color for requested refund (Tailwind bg-blue-600)
                                    $textColor = '#eff6ff';         // Light blue text (Tailwind text-blue-100)
                                } elseif ($order->refund_status === 'approved') {
                                    $refundStatus = 'Refund Approved';
                                    $backgroundColor = '#10b981';  // Green color for approved refund (Tailwind bg-green-500)
                                    $textColor = '#d1fae5';         // Light green text (Tailwind text-green-100)
                                } elseif ($order->refund_status === 'rejected') {
                                    $refundStatus = 'Refund Rejected';
                                    $backgroundColor = '#ef4444';  // Red color for rejected refund (Tailwind bg-red-500)
                                    $textColor = '#fef2f2';         // Light red text (Tailwind text-red-100)
                                } else {
                                    // No refund status, set order status color
                                    switch ($order->status) {
                                        case 'pending':
                                            $backgroundColor = '#f59e0b'; // Tailwind bg-orange-500
                                            $textColor = '#fef3c7';       // Tailwind text-orange-100
                                            break;
                                        case 'shipped':
                                            $backgroundColor = '#f59e0b'; // Tailwind bg-orange-500
                                            $textColor = '#fef3c7';       // Tailwind text-orange-100
                                            break;
                                        case 'complete':
                                            $backgroundColor = '#22c55e'; // Tailwind bg-green-500
                                            $textColor = '#d1fae5';       // Tailwind text-green-100
                                            break;
                                        case 'cancelled':
                                            $backgroundColor = '#ef4444'; // Tailwind bg-red-500
                                            $textColor = '#fef2f2';       // Tailwind text-red-100
                                            break;
                                        case 'refunded':
                                            $backgroundColor = '#3b82f6'; // Tailwind bg-blue-600
                                            $textColor = '#eff6ff';       // Tailwind text-blue-100
                                            break;
                                        case 'delivered':
                                            $backgroundColor = '#22c55e'; // Tailwind bg-green-500
                                            $textColor = '#d1fae5';       // Tailwind text-green-100
                                            break;
                                        default:
                                            $backgroundColor = '#d1d5db'; // Default gray color
                                            $textColor = '#4b5563';       // Default gray text
                                            break;
                                    }
                                }
                            @endphp
                        
                            <!-- Apply the dynamic background and text color inline -->
                            <span class="px-2 py-1 rounded"
                                style="background-color: {{ $backgroundColor }}; color: {{ $textColor }};">
                                {{ $refundStatus ?: ucfirst($order->status) }}
                            </span>
                        </td>
                        
                        
                        
                        
                        
                        
                        <td class="px-4 py-3">
                            {{ $order->created_at->format('M d, Y h:i A') }}
                        </td>
                        
                        <td class="px-4 py-3 text-center space-x-2">
                            @if($order->status === 'pending')
                                {{-- Cancel Order Trigger --}}
                                <button 
                                    x-data 
                                    x-on:click="$dispatch('open-modal', { type: 'cancel', orderId: {{ $order->id }} })" 
                                    class="text-red-600 hover:underline"
                                >
                                ❌ Cancel
                                </button>
                            @elseif($order->refund_status === 'none' && ($order->status === 'delivered' || $order->status === 'shipped'))
                                {{-- Refund Request Trigger --}}
                                <div x-data="{ open: false }" class="relative inline-block text-left">
                                    <button x-on:click="open = !open" class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-ellipsis-h text-xl"></i> {{-- 3 Dots Icon --}}
                                    </button>
                                
                                    <div x-show="open" @click.away="open = false" 
                                        class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                
                                        <div class="py-1">
                                            {{-- Confirm Order --}}
                                            <form method="POST" action="{{ route('users.profile-order.confirmOrder', $order->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-gray-100">
                                                    ✅ Confirm Order
                                                </button>
                                            </form>
                                
                                            {{-- Request Refund --}}
                                            <button 
                                                x-on:click="$dispatch('open-modal', { type: 'refund', orderId: {{ $order->id }} }); open = false"
                                                class="block w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-100"
                                            >
                                                🔄 Request Refund
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($order->refund_status === 'requested')
                                {{-- Cancel Refund Form Trigger --}}
                                <form method="POST" action="{{ route('users.profile-order.cancelrefund', $order->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-blue-600 hover:underline">
                                        Cancel Refund
                                    </button>
                                </form>
                                @elseif (in_array($order->status, ['shipped', 'delivered']))
<div x-data="{ open: false }" class="relative inline-block text-left">
    <button x-on:click="open = !open" class="text-gray-600 hover:text-gray-900">
        <i class="fas fa-ellipsis-h text-xl"></i> {{-- 3 Dots Icon --}}
    </button>

    <div x-show="open" @click.away="open = false" 
        class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">

        <div class="py-1">
            {{-- Confirm Order --}}
            <form method="POST" action="{{ route('users.profile-order.confirmOrder', $order->id) }}">
                @csrf
                @method('PATCH')
                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-gray-100">
                    ✅ Confirm Order
                </button>
            </form>

            {{-- Request Refund --}}
            <button 
                x-on:click="$dispatch('open-modal', { type: 'refund', orderId: {{ $order->id }} }); open = false"
                class="block w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-100"
            >
                🔄 Request Refund
            </button>
        </div>
    </div>
</div>

                                </div>
                            @else
                                <span class="text-gray-400 italic">N/A</span>
                            @endif
                        </td>
                        
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

<!-- Modal for Cancel/Refund -->
<div 
    x-data="{ showModal: false, reason: '', orderId: null, type: '' }"
    x-on:open-modal.window="showModal = true; orderId = $event.detail.orderId; type = $event.detail.type"
    x-cloak
>
    <div 
        x-show="showModal"
        x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
        <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
            <h3 class="text-lg font-semibold mb-4" x-text="type === 'refund' ? 'Request Refund' : 'Cancel Order'"></h3>
            <form 
                :action="`/users/profile/my-orders/${orderId}/${type}`" 
                method="POST"
            >
                @csrf
                @method('PATCH')

                <label class="block text-sm font-medium text-gray-700 mb-1">Reason:</label>
                <select 
    name="reason" 
    x-model="reason"
    required 
    class="w-full border rounded px-3 py-2"
>
    <option value="" disabled>Select a reason</option>
    <option value="Changed my mind">Changed my mind</option>
    <option value="Found a better price">Found a better price</option>
    
    <!-- Conditionally render the 'Item defect or issue' option only when it's a refund request -->
    <option 
        x-show="type === 'refund'" 
        value="Item defect or issue"
    >
        Item defect or issue
    </option>

    <option value="Other">Other</option>
</select>


                <!-- Input for custom reason if 'Other' is selected -->
                <template x-if="reason === 'Other'" class="mt-2">
                    <label class="block text-sm text-gray-700">Please specify:</label>
                    <input 
                        type="text" 
                        name="custom_reason" 
                        class="w-full border rounded px-3 py-2 mt-1" 
                        placeholder="Type your reason here..."
                    >
                </template>

                <div class="mt-4 flex justify-end space-x-2">
                    <button 
                        type="button" 
                        x-on:click="showModal = false" 
                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
                    >
                        Cancel
                    </button>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
