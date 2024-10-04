@extends('layouts.LOAdmin.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


    {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="antialiased ">





<div class="container">
    <table class="table table-hover text-center">
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
                {{$d->password}}
                </td>


                <td>
                
                <button class="btn btn-danger" disabled>
    <i class="fas fa-trash-alt"></i> Delete
</button>



                </td>

            </tr>
            @endforeach


        </tbody>
    </table>
</div>



</body>
</html>
@endsection
