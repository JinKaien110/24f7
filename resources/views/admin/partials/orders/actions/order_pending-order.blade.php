<form action="{{ route('orders.pending', $order->id) }}" method="POST" class="d-inline">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-sm btn-warning rounded-circle" title="Pending">
        <i class="bi bi bi-pause-circle"></i>
    </button>
</form>