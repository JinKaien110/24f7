<div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">Product Type</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="" disabled>-- Select Product Type --</option>
                                    <option value="Split">Split</option>
                                    <option value="Window">Window</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="horsepower" class="form-label">Horsepower</label>
                                <select class="form-control" id="horsepower" name="horsepower" required>
                                    @foreach ([0.5, 0.8, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 5.0, 6.0, 7.5, 8.0, 10.0, 15.0, 20.0] as $hp)
                                        <option value="{{ $hp }}">{{ $hp }}</option>
                                    @endforeach
                                </select>
                            </div>

                            

                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <select class="form-control" id="brand" name="brand" required>
                                    <option value="" disabled>-- Select Brand --</option>
                                    <option value="Daikin">Daikin</option>
                                    <option value="Carrier">Carrier</option>
                                    <option value="Midea">Midea</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="model_name" class="form-label">Model Name</label>
                                <input type="text" class="form-control" id="model_name" name="model_name" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>

                            {{-- <div class="mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                            </div> --}}

                            <div class="mb-3">
                                <label for="reorder_level" class="form-label">Reorder Level</label>
                                <input type="number" name="reorder_level" class="form-control" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label for="prefix" class="form-label">Prefix</label>
                                <input type="text" class="form-control" id="prefix" name="prefix">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>