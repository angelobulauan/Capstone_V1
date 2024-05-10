@extends('layouts.LOUser.app')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


{{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<br>
<style>
 .back-video{
    position: absolute;
  }
</style>
<body>

<video autoplay loop muted plays-inline class="back-video">
      <source src="{{asset('img/wl/vb6.mp4')}}" type="video/mp4">
      </video>
<div class="row">

  @foreach($myEntry as $d)
  <div class="col-sm-6 col-md-3 col-lg-4">
    <br>
    <div class=" mb-3 mb-sm-0">
      <div class="card " style="width: 20rem;">
        <img src="{{asset('img/bg.jpg')}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Name: {{$d->name}}</h5>
          <p class="card-text">Scientific Name: {{$d->scientificname}}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Description: {{$d->description}}</li>

        </ul>
        <div class="card-body">
          <a href="#" class="btn btn-primary">View more details</a>
          <a href="#" class="btn btn-secondary"><i class="fa fa-heart" aria-hidden="true"></i></a>
          <a href="#" class="btn btn-danger"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
          

        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
</body>

@endsection