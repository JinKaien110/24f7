<div class="container my-4">
    <div class="row">
        <!-- Left: Product List -->
        <div class="col-md-8">
            <h2>Products</h2>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="text-muted">Price: ${{ number_format($product->price, 2) }}</p>
                                <form wire:submit.prevent="addToCart({{ $product->id }}, $event.target.quantity.value)">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="number" name="quantity" min="1" required placeholder="Quantity" class="form-control w-50">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right: Cart Section -->
        <div class="col-md-4">
            <h2>Your Cart</h2>

            @if (empty($cart))
                <p>Your cart is empty.</p>
            @else
                <div class="list-group">
                    @foreach ($cart as $productId => $item)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" width="50" class="mr-3">
                            <div>
                                <p class="mb-1"><strong>{{ $item['name'] }}</strong></p>
                                <small>Qty: {{ $item['quantity'] }}</small>
                                <p class="mb-0">Total: ${{ number_format($item['total_amount'], 2) }}</p>
                            </div>
                            <button wire:click="removeFromCart({{ $productId }})" class="btn btn-danger btn-sm">Remove</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-success mt-3" data-toggle="modal" data-target="#checkoutModal">
                    Proceed to Checkout
                </button>
            @endif
        </div>
    </div>

        <!-- Checkout Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('users.orders.finalize') }}" method="POST">
                            @csrf
    
                            <!-- Display Cart Items -->
                            <h5>Cart Items:</h5>
                            <ul class="list-group mb-3">
                                @foreach ($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <strong>{{ $item['name'] }}</strong>
                                        <div>Quantity: {{ $item['quantity'] }}</div>
                                        <span class="badge badge-primary badge-pill">${{ number_format($item['total_amount'], 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
    
                            <!-- Total Amount -->
                            <div class="mb-3">
                                <h6><strong>Total Amount: </strong> ${{ number_format(array_sum(array_column($cartItems, 'total_amount')), 2) }}</h6>
                            </div>
    
                            <!-- Payment Method Selection -->
                            <div class="form-group">
                                <label for="payment_method">Select Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="gcash">GCash</option>
                                    <option value="paymaya">PayMaya</option>
                                </select>
                            </div>
    
                            <!-- Amount Paid -->
                            <div class="form-group">
                                <label for="amount_paid">Amount Paid</label>
                                <input type="number" name="amount_paid" id="amount_paid" class="form-control" placeholder="Enter amount paid" required>
                            </div>
    
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success btn-block">Confirm Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
