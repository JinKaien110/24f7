<!-- View -->
<button class="btn btn-sm btn-info text-white rounded-circle" data-bs-toggle="modal" data-bs-target="#viewUserModal-{{ $user->id }}">
    <i class="bi bi-eye"></i>
</button>

<!-- Edit -->
<button class="btn btn-sm btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editUserModal-{{ $user->id }}">
    <i class="bi bi-pencil-square"></i>
</button>

<!-- Delete -->
{{-- <form action="{{ route('system_user.delete', $user->id) }}" method="POST" class="d-inline">
    @csrf @method('DELETE')
    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger rounded-circle"><i class="bi bi-trash"></i></button>
</form> --}}

<!-- Modals -->
@include('admin.partials.system_users.system_user_edit_modal', ['user' => $user])
@include('admin.partials.system_users.system_user_view_modal', ['user' => $user])
