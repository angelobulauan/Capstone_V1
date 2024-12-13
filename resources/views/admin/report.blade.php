<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reports</title>
    <link rel="shortcut icon" href="{{asset('favicon.png') }}">
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
            <button type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Export to Excel</button>
        </form>
        <br><br>
        @if($reports->isEmpty())
            <p class="text-center">No reports available.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th><i class="fas fa-microscope"></i> Scientific Name 1</th>
                        <th><i class="fas fa-microscope"></i> Scientific Name 2</th>
                        <th><i class="fas fa-microscope"></i> Scientific Name 3</th>
                        <th><i class="fas fa-info-circle"></i> Description</th>
                        <th><i class="fas fa-map-marker-alt mr-1"></i>Location</th>
                        <th><i class="fas fa-calendar-alt"></i> Date Published</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->scientificname1 }}</td>
                            <td>{{ $report->scientificname2 }}</td>
                            <td>{{ $report->scientificname3 }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($report->description, 50) }}</td>
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

