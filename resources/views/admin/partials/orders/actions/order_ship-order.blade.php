<form method="POST" action="{{ route('orders.ship', $order->id) }}">
    @csrf
    @method('PATCH')
    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-blue-600 hover:bg-gray-100">
        📦 Mark as Shipped
    </button>
</form>
