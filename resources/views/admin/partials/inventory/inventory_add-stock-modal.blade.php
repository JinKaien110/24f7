<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockModalLabel">Add Serial Number to Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('inventory.add') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Select Product -->
                        <div class="col-md-6 mb-3">
                            <label for="product_id" class="form-label">Select Product</label>
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="" disabled selected>-- Select Product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}" data-prefix="{{ $product->prefix }}">{{ $product->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <!-- Input Serial Number -->
                        <div class="col-md-6 mb-3">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required placeholder="Enter unique serial number">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
