<!-- resources/views/admin/partials/products/edit_product_modal.blade.php -->
<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="model_name" class="form-label">Model Name</label>
                                <input type="text" class="form-control" id="model_name" name="model_name" value="{{ $product->model_name }}">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="type" name="type" value="{{ $product->type }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="horsepower" class="form-label">Horsepower</label>
                                <select class="form-control" id="horsepower" name="horsepower" required>
                                    @foreach ([0.5, 0.8, 1.0, 1.5, 2.0, 2.5, 3.0, 3.5, 4.0, 5.0, 6.0, 7.5, 8.0, 10.0, 15.0, 20.0] as $hp)
                                        <option value="{{ $hp }}" {{ $product->horsepower == $hp ? 'selected' : '' }}>{{ $hp }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>

                        <!-- Column 2 -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" step="any" required>
                            </div>
                            <div class="mb-3">
                                <label for="brand" class="form-label">Brand</label>
                                <input type="text" class="form-control" id="brand" name="brand" value="{{ $product->brand }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
