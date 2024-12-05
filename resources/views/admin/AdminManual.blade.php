@extends('layouts.LOAdmin.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Manual</title>
    <style>
        iframe {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    @section('content')
    <iframe src="{{ asset('Admin_MANUAL.pdf') }}" width="1000px" height="1000px" style="border:none;"></iframe>
    @endsection
</object>
</body>
</html>

