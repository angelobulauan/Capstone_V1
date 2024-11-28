<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Request</title>
    <style>
        @media (max-width: 768px) {
            .container {
                padding: 0 1rem;
            }

            table th, table td {
                font-size: 0.875rem;
                padding: 0.5rem;
            }

            .btn {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    @extends('layouts.LOUser.app')

    @section('content')
        <div style="margin-top: 5rem;" class="container">
            @if ($pending->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">
                                    <i class="fa fa-microscope"></i> Scientific Name 1
                                </th>
                                <th scope="col">
                                    <i class="fa fa-microscope"></i> Scientific Name 2
                                </th>
                                <th scope="col">
                                    <i class="fa fa-microscope"></i> Scientific Name 3
                                </th>
                                <th scope="col">
                                    <i class="fas fa-info-circle"></i> Description
                                </th>
                                <th scope="col">
                                    <i class="fas fa-map-marker-alt"></i> Location
                                </th>
                                <th scope="col">
                                    <i class="fas fa-hourglass-half"></i> Status
                                </th>
                                <th scope="col">
                                    <i class="fas fa-cog"></i> Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending as $d)
                                <tr>
                                    <td>{{ $d->scientificname1 }}</td>
                                    <td>{{ $d->scientificname2 }}</td>
                                    <td>{{ $d->scientificname3 }}</td>
                                    <td>{{ $d->description }}</td>
                                    <td>{{ $d->location }}</td>
                                    <td>{{ $d->status }}</td>
                                    <td>
                                        <a href="{{ route('request.requests.edit', ['id' => $d->id]) }}" class="btn btn-primary me-2 py-0">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('request.requests.destroy', ['id' => $d->id]) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger py-0">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <h2 class="text-center">No request has been made</h2>
            @endif
        </div>
    @endsection

    <script>
        $(document).ready(function() {
            $('.btn-danger').click(function(event) {
                event.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>

