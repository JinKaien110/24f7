<section id="products">
    <h2>Products</h2>
    @if ($products->isEmpty())
        <p>No products found for "{{ request('query') }}".</p>
    @else
        @foreach ($products as $product)
            <div>{{ $product->name }}</div>
        @endforeach
    @endif
</section>
