<div class="modal fade" id="deleteModal-{{ $stock->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $stock->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('deleteStock', $stock->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete stock for <strong>{{ $stock->product->name }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" type="submit">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
