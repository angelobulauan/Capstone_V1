<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
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
                            <a href="" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>

                            <a href="" class="btn btn-danger">
                                <i class="fas fa-ban"></i> Disable
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endsection
</body>
</html>



