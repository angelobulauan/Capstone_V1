<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    @extends('layouts.LOSuperAdmin.app')
    @section('content')
        <div class="container mt-5">
            <h1 class="mb-4">Manage Users</h1>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- User List -->
            <h2>All Users</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alluser as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <!-- Trigger the edit modal -->
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal" data-id="{{ $user->id }}"
                                    data-name="{{ $user->name }}" data-email="{{ $user->email }}">
                                    Edit
                                </button>

                                @if ($user->status !== 'disabled')
                                    <form action="{{ route('superadmin.user.disable', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning btn-sm">Disable</button>
                                    </form>
                                @else
                                    <form action="{{ route('superadmin.user.activate', $user->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Activate</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $alluser->links() }}
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editUserForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="userId" name="id">

                            <div class="mb-3">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" id="userName" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="email" id="userEmail" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Password (optional)</label>
                                <input type="password" id="userPassword" name="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="userPasswordConfirmation" class="form-label">Confirm Password</label>
                                <input type="password" id="userPasswordConfirmation" name="password_confirmation"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Include Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- JavaScript for Populating Modal -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const editUserModal = document.getElementById('editUserModal');
                const editUserForm = document.getElementById('editUserForm');

                // Base URL for the update route
                const baseUrl = `{{ url('superadmin/users') }}`;

                editUserModal.addEventListener('show.bs.modal', (event) => {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-id');
                    const userName = button.getAttribute('data-name');
                    const userEmail = button.getAttribute('data-email');

                    // Update the form's action dynamically
                    editUserForm.action = `${baseUrl}/${userId}`;

                    // Populate the form fields
                    document.getElementById('userId').value = userId;
                    document.getElementById('userName').value = userName;
                    document.getElementById('userEmail').value = userEmail;
                });
            });
        </script>
    @endsection
</body>

</html>
