<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('system_users.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5>Add User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2"><label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required></div>
                    <div class="mb-2"><label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" required></div>
                    <div class="mb-2"><label>Email</label>
                        <input type="email" name="email" class="form-control" required></div>
                    <div class="mb-2"><label>Password</label>
                        <input type="password" name="password" class="form-control" required></div>
                    <div class="mb-2"><label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required></div>
                    <div class="mb-2"><label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
