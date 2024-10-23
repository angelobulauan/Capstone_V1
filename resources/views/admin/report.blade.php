<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <style>
        .container {
            margin-top: 100px;
        }
        table {
            width: 100%;
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: green;
            color: white;
        }
    </style>
</head>
<body>
    @extends('layouts.LOAdmin.app')
    @section('content')

    <div class="container">
        <form action="{{ route('admin.export') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Export to Excel</button>
        </form>
        <br><br>
        @if($reports->isEmpty())
            <p class="text-center">No reports available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Scientific Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Date Published</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->scientificname }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ date('m-d-Y', strtotime($report->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $reports->links() }}
        @endif

    </div>

    @endsection
</body>
</html>

