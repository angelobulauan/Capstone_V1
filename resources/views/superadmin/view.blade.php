<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">
</head>

<body>
    @extends('layouts.LOSuperadmin.app')
    @section('content')
        <div class="container mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-primary"><i class="fas fa-users"></i> Manage Users</h1>
                {{--     --}}
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-triangle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- User List -->
            <h2 class="text-secondary"><i class="fas fa-list"></i> All Users</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th><i class="fas fa-user"></i> Name</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-toggle-on"></i> Status</th>
                            <th><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alluser as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->status === 'disabled' ? 'bg-danger' : 'bg-success' }}">
                                        {{ ucfirst($user->status) }}
                                    </span>
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editUserModal" data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}" data-email="{{ $user->email }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    <!-- Disable/Enable Button -->
                                    @if ($user->status !== 'disabled')
                                        <form action="{{ route('superadmin.user.disable', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="fas fa-user-slash"></i> Disable
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('superadmin.user.activate', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fas fa-user-check"></i> Activate
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

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

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="editUserModalLabel"><i class="fas fa-user-edit"></i> Edit User</h5>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update User</button>
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
