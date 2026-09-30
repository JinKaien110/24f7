<!-- Create Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-dark text-white rounded-top-4">
                    <h5 class="modal-title">🛒 Create New Order</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Top Fields -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="user_id" class="form-label">👤 Select User</label>
                            <select name="user_id" class="form-select" required>
                                <option disabled selected>-- Choose User --</option>
                                @foreach($usersForDropdown as $user)
                                    <option value="{{ $user->id }}">{{ ucfirst($user->first_name) }} {{ ucfirst($user->last_name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">💳 Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                <option disabled selected>-- Select --</option>
                                <option value="cash">Cash</option>
                                <option value="paymaya">PayMaya</option>
                                <option value="gcash">GCash</option>
                            </select>
                        </div>                        
                    </div>
                    <hr>

                    <div class="row">
                        <!-- LEFT: Product Selection -->
                        <div class="col-md-6 border-end pe-4">
                            <h5>🧾 Add Product</h5>
                            <div class="mb-3">
                                <label class="form-label">Product</label>
                                <select id="productSelect" class="form-select" required>
                                    <option disabled selected>-- Select Product --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                                            {{ $product->name }} - ₱{{ number_format($product->price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" id="productQty" class="form-control" min="1" value="1">
                            </div>
                            <button type="button" id="addToCartBtn" class="btn btn-primary w-100">➕ Add to Cart</button>
                        </div>

                        <!-- RIGHT: Cart and Summary -->
                        <div class="col-md-6 ps-4">
                            <h5>🛒 Cart</h5>
                            <div id="cartItems" class="mb-3"></div>

                            <hr>

                            <div class="row mb-2">
                                <div class="col">Subtotal</div>
                                <div class="col text-end" id="subtotal">₱0.00</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">VAT (12%)</div>
                                <div class="col text-end" id="vat_amount">₱0.00</div>
                            </div>
                            <div class="row mb-2 fw-bold">
                                <div class="col">Total</div>
                                <div class="col text-end" id="total_amount">₱0.00</div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Amount Paid</label>
                                <input type="number" step="0.01" name="amount_paid" class="form-control" id="amountPaid" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Change</label>
                                <input type="text" class="form-control" id="change" readonly>
                            </div>
                        </div>
                    </div>

                    <div id="cartHiddenInputs"></div>


                </div>

                <div class="modal-footer bg-light rounded-bottom-4">
                    <button type="submit" class="btn btn-success">🧾 Submit Order</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@vite('resources/js/admin-orders.js')