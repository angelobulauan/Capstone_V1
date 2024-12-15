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

    <style>
        /* Modal Body Styling */
        .modal-body {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            font-family: Arial, sans-serif;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 1rem;
            text-align: left;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Table Header Styling */
        .styled-table thead tr {
            background-color: #0d6efd;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        /* Table Rows Styling */
        .styled-table th, .styled-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        /* Alternating Row Background */
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        /* Row Hover Effect */
        .styled-table tbody tr:hover {
            background-color: #d1e7ff;
        }

        /* Image Styling */
        .id-image {
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 5px;
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Modal Header Styling */
        .modal-header {
            background-color: #0d6efd;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        /* Modal Title Styling */
        .modal-title {
            font-weight: bold;
            font-size: 1.25rem;
            margin: 0;
        }

        /* Responsive Table */
        .table-responsive {
            overflow-x: auto;
        }

    </style>
</head>
<body>
    @extends('layouts.LOSuperAdmin.app')
    @section('content')

    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><i class="fas fa-envelope"></i> Email</th>
                        <th scope="col"><i class="fas fa-lock"></i> Password</th>
                        <th scope="col"><i class="fas fa-cogs"></i> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alluser as $d)
                        <tr>
                            <td>{{$d->email}}</td>
                            <td><i class="fas fa-lock"></i></td>
                            <td>
                                <!-- View Button -->
                                <button
                                    class="btn btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewUserModal"
                                    onclick="populateViewModal({{ json_encode($d) }})">
                                    <i class="fas fa-eye"></i> View
                                </button>

                                <!-- Edit Button -->
                                <button
                                    class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                    onclick="populateEditModal({{ json_encode($d) }})">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <!-- Disable Button -->
                                <form action="{{ route('superadmin.superadmin.user.disable', $d->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE') <!-- This is correct since the route is DELETE -->
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
    </div>

    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="{{ asset('img/bg1.png') }}" alt="Logo" class="img-fluid me-3" style="height: 40px;">
                    <h5 class="modal-title" id="viewUserModalLabel">User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="styled-table">
                        <tbody>
                            <tr>
                                <td><strong>Name</strong></td>
                                <td><span id="viewUserName" class="detail-text"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><span id="viewUserEmail" class="detail-text"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Date of Birth</strong></td>
                                <td><span id="viewUserDob" class="detail-text"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Sex</strong></td>
                                <td><span id="viewUserSex" class="detail-text"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td><span id="viewUserAddress" class="detail-text"></span></td>
                            </tr>
                            <tr>
                                <td><strong>ID Number</strong></td>
                                <td><span id="viewUserIdNumber" class="detail-text"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Password</strong></td>
                                <td><span id="viewUserPassword" class="detail-text"></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST" action="{{ route('superadmin.superadmin.user.update', $d->id) }}">
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
        // Populate the view modal with user data
        function populateViewModal(user) {
            document.getElementById('viewUserName').textContent = user.name;
            document.getElementById('viewUserEmail').textContent = user.email;
            document.getElementById('viewUserDob').textContent = user.date_of_birth;
            document.getElementById('viewUserSex').textContent = user.sex;
            document.getElementById('viewUserAddress').textContent = user.address;
            document.getElementById('viewUserIdNumber').textContent = user.id_number;
            document.getElementById('viewUserIdImage').src = user.id_image;
        }

        // Populate the edit modal with user data
        function populateEditModal(user) {
            const form = document.getElementById('editUserForm');
            form.action = `/users/${user.id}`; // Adjust the route as needed
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
        }

        document.addEventListener("DOMContentLoaded", () => {
            const password = "userpassword123"; // Replace with your dynamic password logic
            const maskedPassword = "*".repeat(password.length); // Masking the password
            document.getElementById("viewUserPassword").textContent = maskedPassword;
        });
    </script>
</body>
</html>
