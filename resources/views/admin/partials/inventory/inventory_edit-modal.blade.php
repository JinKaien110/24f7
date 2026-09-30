<div class="modal fade" id="editModal-{{ $stock->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $stock->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('updateStock', $stock->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Reorder Level</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reorder_level" class="form-label">Reorder Level</label>
                        <input type="number" name="reorder_level" class="form-control" value="{{ $stock->reorder_level }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>