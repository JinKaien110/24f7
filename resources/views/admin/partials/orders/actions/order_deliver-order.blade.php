<form method="POST" action="{{ route('orders.deliver', $order->id) }}">
    @csrf
    @method('PATCH')
    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-indigo-600 hover:bg-gray-100">
        🚚 Mark as Delivered
    </button>
</form>
