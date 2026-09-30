<!-- View User Modal -->
<div class="modal fade" id="viewUserModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header bg-gradient text-white rounded-top-4" style="background: linear-gradient(135deg, #007bff, #6610f2);">
                <h5 class="modal-title fw-semibold">User Profile</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <div class="d-flex flex-column align-items-center text-center mb-4">
                    <div class="bg-light rounded-circle p-2 mb-3" style="width: 100px; height: 100px;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->first_name . ' ' . $user->last_name) }}&background=red&color=fff&size=100"
                             alt="Avatar" class="img-fluid rounded-circle w-100 h-100">
                    </div>
                    <h5 class="mb-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <small class="text-muted">Role</small>
                            <div>
                                <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : 'secondary' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <small class="text-muted">Status</small>
                            <div>
                                @if ($user->trashed())
                                    <span class="badge bg-danger">Archived</span>
                                @elseif($user->status == 'deactivated')
                                    <span class="badge bg-warning text-dark">Deactivated</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bg-light p-3 rounded">
                            <small class="text-muted">Created At</small>
                            <div>{{ $user->created_at->format('F j, Y g:i A') }}</div>
                        </div>
                    </div>

                    @if ($user->trashed())
                        <div class="col-md-6">
                            <div class="bg-light p-3 rounded">
                                <small class="text-muted">Deleted At</small>
                                <div>{{ $user->deleted_at->format('F j, Y g:i A') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="modal-footer bg-white border-top-0 rounded-bottom-4 px-4 py-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                @if ($user->status == 'deactivated' || $user->trashed())
                    <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-info">Restore</button>
                    </form>
                @elseif ($user->status == 'active')
                    <form action="{{ route('users.toggleStatus', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning">Deactivate</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
