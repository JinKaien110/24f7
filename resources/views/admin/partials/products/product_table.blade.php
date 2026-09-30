<!-- Table -->
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="bg-light">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Type</th>
                <th>Stock</th>
                <th>Horsepower</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Image of {{ $product->name }}" width="80" height="80" class="rounded img-thumbnail">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->stock->quantity ?? 'No stock available' }}</td>
                    <td>{{ $product->horsepower }} HP</td>
                    <td>{{ $product->brand }}</td>
                    <td>₱{{ number_format($product->price, 2) }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Product actions">
                            <!-- View Button -->
                            <button class="btn btn-sm btn-info rounded-circle" data-bs-toggle="modal" data-bs-target="#viewProductModal{{ $product->id }}" title="View Product">
                                <i class="bi bi-eye"></i>
                            </button>

                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}" title="Edit Product">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <!-- Delete Button -->
                            <button class="btn btn-sm btn-danger rounded-circle" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}" title="Delete Product">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $products->links() }}
</div>

<!-- Modals (outside the table to avoid layout issues) -->
@foreach ($products as $product)
    @php
        $serialNumbers = \App\Models\ProductSerial::where('product_id', $product->id)->get();
    @endphp

    @include('admin.partials.products.product_view-product-modal', [
        'product' => $product,
        'serialNumbers' => $serialNumbers
    ])
    @include('admin.partials.products.product_edit-product-modal', ['product' => $product])
    @include('admin.partials.products.product_delete-product-modal', ['product' => $product])
@endforeach
