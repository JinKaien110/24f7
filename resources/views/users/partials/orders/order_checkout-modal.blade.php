<!-- 🛒 Checkout Modal -->
<div id="checkoutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
    <div class="bg-white w-full max-w-2xl rounded-xl shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Checkout Summary</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-black text-xl">&times;</button>
            </div>

            {{-- 🧾 Cart Table --}}
            <div class="overflow-x-auto max-h-60 overflow-y-auto border rounded mb-4">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-100 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-2">Product</th>
                            <th class="px-4 py-2">Qty</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                            $vat = 0;
                            $total = 0;
                        @endphp
                        @foreach (session('cart', []) as $item)
                            @php
                                $item_total = $item['price'] * $item['quantity'];
                                $subtotal += $item_total;
                                $vat += $item_total * 0.12;
                                $total = $subtotal + $vat;
                            @endphp
                            <tr>
                                <td class="px-4 py-2 font-medium">{{ $item['name'] }}</td>
                                <td class="px-4 py-2" id="quantity-{{ $item->id }}">{{ $item['quantity'] }}</td>
                                <td class="px-4 py-2">₱{{ number_format($item['price'], 2) }}</td>
                                <td class="px-4 py-2">₱{{ number_format($item_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 🧮 Totals --}}
            <div class="mb-4 space-y-1 text-right">
                <p class="text-sm">Subtotal: ₱{{ number_format($subtotal, 2) }}</p>
                <p class="text-sm">VAT (12%): ₱{{ number_format($vat, 2) }}</p>
                <p class="font-bold text-lg text-blue-700">Total: ₱<span id="checkoutTotal">{{ number_format($total, 2) }}</span></p>
            </div>

            {{-- 💳 Payment Form --}}
            <form action="{{ route('users.orders.finalize') }}" method="POST" onsubmit="return validateCheckout()">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                        <select name="payment_method" id="payment_method" required class="w-full rounded border-gray-300">
                            <option value="">-- Select --</option>
                            <option value="cash">Cash</option>
                            <option value="gcash">GCash</option>
                            <option value="paymaya">PayMaya</option>
                        </select>
                    </div>
                    <div>
                        <label for="amount_paid" class="block text-sm font-medium text-gray-700 mb-1">Amount Paid</label>
                        <input type="number" step="0.01" name="amount_paid" id="amount_paid" oninput="calculateChange()" required class="w-full rounded border-gray-300">
                    </div>
                </div>

                {{-- 💵 Change --}}
                <div class="mt-4 text-right">
                    <p class="text-sm text-gray-600">Change: ₱<span id="changeDisplay">0.00</span></p>
                </div>

                {{-- ✅ Buttons --}}
                <div class="mt-6 flex justify-end gap-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 rounded border hover:bg-gray-100">Cancel</button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Confirm Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>
