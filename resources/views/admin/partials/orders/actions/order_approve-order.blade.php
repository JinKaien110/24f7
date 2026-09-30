<form method="POST" action="{{ route('orders.approveRefund', $order->id) }}">
    @csrf
    @method('PATCH')
    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-gray-100">
        ✅ Approve Refund
    </button>
</form>
