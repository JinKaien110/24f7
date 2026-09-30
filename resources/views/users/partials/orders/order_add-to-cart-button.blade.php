<form action="{{ route('users.cart.add', $product->id) }}"
    method="POST"
    class="add-to-cart-form"
    data-product-id="{{ $product->id }}">
  @csrf
  <input type="hidden" name="product_id" value="{{ $product->id }}">
  <input type="hidden" name="quantity" value="1">
  <button type="submit" class="w-full py-2 rounded-xl bg-blue-500 text-white font-semibold hover:bg-blue-600 transition-all">
      🛒 Add to Cart
  </button>
</form>
