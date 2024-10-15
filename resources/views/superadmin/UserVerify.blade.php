<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Verify</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @extends('layouts.LOSuperAdmin.app')

    @section('content')
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if (count($users) < 1)
                        <div class="card">
                            <div class="card-header">Verify User</div>

                            <div class="card-body">
                                <h2 class="text-center">No User to Verify</h2>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">Verify User</div>

                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div style="overflow-x:auto;">
                                    <table class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td style="padding-top: 10px;">
                                                        <button type="button" class="btn btn-info" style="margin-bottom: 10px;"
                                                            data-toggle="modal" data-target="#exampleModal-{{ $user->id }}">
                                                            View Qualification
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal-{{ $user->id }}"
                                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">User
                                                                            Qualification</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <table class="table table-striped">
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <td>{{ $user->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>Email</th>
                                                                                <td>{{ $user->email }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th>ID Image</th>
                                                                                <td>
                                                                                    <a href="{{ asset('storage/' . $user->id_img) }}" data-fancybox>
                                                                                        <img src="{{ asset('storage/' . $user->id_img) }}"
                                                                                            width="500" height="500" />
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                        <form action="{{ route('superadmin.verified', $user->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input type="hidden" name="is_verified" value="1">
                                                                            <button type="submit" class="btn btn-success" style="display:block;margin: 0 auto;">Verify</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <form action="{{ route('superadmin.reject', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="involvement" value="viewer">
                                                            <button type="submit" class="btn btn-danger">Reject</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection

</body>

</html>


