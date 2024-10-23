<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request</title>
</head>

<body>
    @extends('layouts.LOUser.app')

    @section('content')
        <div style="margin-top: 5rem;" class="container">
            @if ($pending->count() > 0)
                <table class="table table-hover text-center">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">
                                <i class="fa fa-leaf "></i> Name
                            </th>

                            <th scope="col">
                                <i class="fa fa-microscope"></i> Scientific Name
                            </th>

                            <th scope="col">
                                <i class="fas fa-info-circle"></i> Description </th>

                                <th scope="col">
                                    <i class="fas fa-map-marker-alt"></i> Location </th>

                                    <th scope="col"> <i class="fas fa-hourglass-half "></i> Status </th>

                                    <th scope="col"> <i class="fas fa-cog"></i> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending as $d)
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->scientificname }}</td>
                                <td>{{ $d->description }}</td>
                                <td>{{ $d->location }}</td>
                                <td>{{ $d->status }}</td>
                                <td>
                                    <button class="btn btn-primary me-2 py-0" data-bs-toggle="modal"
                                                    data-bs-target="#edit-addnew-{{ $d->req_id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger py-0">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h2 class="text-center">No request has been made</h2>
            @endif
        </div>
    @endsection

</body>

</html>

