        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ ucfirst($user->first_name) }}</td>
                        <td>{{ ucfirst($user->last_name) }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <!-- Display status: Active, Deactivated, or Archived -->
                            @if ($user->trashed())
                            <span class="badge bg-danger text-white">Archived</span>
                            @elseif ($user->status == 'deactivated')
                            <span class="badge bg-warning text-dark">Deactivated</span>
                            @else
                            <span class="badge bg-success">Active</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <!-- Actions -->
                               @include('admin.partials.system_users.system_user_actions')
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
