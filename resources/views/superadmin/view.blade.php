<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="shortcut icon" href="{{asset('favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @extends('layouts.LOSuperAdmin.app')
    @section('content')

    <div class="container mt-5">
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">
                        <i class="fas fa-user"></i> Name
                    </th>
                    <th scope="col">
                        <i class="fas fa-envelope"></i> Email
                    </th>
                    <th scope="col">
                        <i class="fas fa-lock"></i> Password
                    </th>
                    <th scope="col">
                        <i class="fas fa-cogs"></i> Action
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach($alluser as $d)
                    <tr>
                        <td>
                            {{$d->name}}
                        </td>
                        <td>
                            {{$d->email}}
                        </td>
                        <td>
                            <i class="fas fa-lock"></i>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <button
                            class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editUserModal"
                            onclick="populateModal({{ json_encode($d) }})">
                            <i class="fas fa-edit"></i> Edit
                        </button>

                        <form action="{{ route('superadmin.user.disable', $d->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to disable this user?')">
                                <i class="fas fa-ban"></i> Disable
                            </button>
                        </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   <!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editUserForm" method="POST" action="{{ route('superadmin.user.update', $d->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="userName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="userPassword" name="password">
                        <small class="form-text text-muted">Leave empty if you do not want to change the password.</small>
                    </div>
                    <div class="mb-3">
                        <label for="userPasswordConfirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="userPasswordConfirmation" name="password_confirmation">
                    </div>
                    <!-- Add other fields as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


    @endsection

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Populate the modal with user data
        function populateModal(user) {
            const form = document.getElementById('editUserForm');
            form.action = `/users/${user.id}`; // Adjust the route as needed
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
        }
    </script>
</body>
</html>
