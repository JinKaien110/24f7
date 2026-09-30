<!-- Edit Modal -->
<div class="modal fade" id="editUserModal-{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('system_users.update', $user->id) }}" method="POST">
            @csrf 
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit User</h5>
                    <button type="button"class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Error Handling -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-2">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                    </div>

                    <div class="mb-2">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                            <option value="user" @selected(old('role', $user->role) == 'user')>User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
