@extends('layouts.LOUser.app')

@section('content')

    <div style="margin-top: 5rem;" class="container">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Scientific Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Location</th>
                    <th scope="col">Status</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
