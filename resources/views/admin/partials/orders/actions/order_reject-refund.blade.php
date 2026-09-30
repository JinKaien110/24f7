<form method="POST" action="{{ route('orders.rejectRefund', $order->id) }}">
    @csrf
    @method('PATCH')
    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
        ❌ Reject Refund
    </button>
</form>
