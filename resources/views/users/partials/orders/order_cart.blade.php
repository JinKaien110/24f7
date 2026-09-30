{{-- 🛒 Cart Sidebar --}}
<aside class="w-full lg:w-[750px] bg-white rounded-2xl shadow-lg border border-gray-200 p-6 sticky top-[130px] h-fit">

    
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🛒 Your Cart</h2>
    @if(count($cartItems) > 0)
        <ul class="divide-y divide-gray-200 max-h-[450px] overflow-y-auto">
            @foreach ($cartItems as $item)
                <li class="py-4 flex justify-between items-start gap-4">
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-14 h-14 object-cover rounded">
                        <div>
                            <p class="font-semibold text-sm text-gray-800">{{ $item['name'] }}</p>
                            <p class="text-xs text-gray-500">₱{{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-bold text-blue-700">₱{{ number_format($item['total_amount'], 2) }}</p>
                        <a href="{{ route('users.orders.removeFromCart', $item['product_id']) }}" class="text-xs text-red-500 hover:underline">Remove</a>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 border-t pt-4 text-right">
            {{-- Include the modal --}}
            @include('users.partials.orders.order_checkout-modal')
        
            {{-- Checkout Button --}}
            <button 
                onclick="openModal()" 
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-200"
            >
                Proceed to Checkout
            </button>            
        </div>
        
    @else
        <p class="text-sm text-gray-500">Your cart is empty.</p>
    @endif
</aside>