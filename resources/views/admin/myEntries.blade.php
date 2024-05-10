@extends('layouts.LOAdmin.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


{{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<br>
<body>
    

@foreach($myEntry as $d)
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <a href="{{route('admin.seapics.edit',$d->id)}}">
                    <img src="{{asset('img/bg.jpg')}} " title="photo" class="img-fluid img-thumbnail" alt="seagrass image">
                
                </a>
            </div>
            <div class="col-sm-8">

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6 p-1"> Name: {{$d->name}}</div>
                            <div class="col-sm-6 p-1">Scientific Name: {{$d->scientificname}}</div>
                            <div class="col-sm-6 p-1"><i class="fa fa-info-circle mr-2 text-primary"></i>Description: {{$d->description}}</div>
                            <div class="col-sm-6 p-1"><i class="fa fa-map-marker mr-2 text-warning"></i>Location: {{$d->location}}</div>
                            <div class="col-sm-6 p-1"><i class="fa fa-map-pin mr-2"></i>Abundance: {{$d->abundance}}</div>
                            
    

                            <div class="col-sm-6 p-1">Created At: {{$d->created_at}}</div>
                            <div class="row mt-0">
                                <!-- <div class="text-center"> -->
                                    <div class="col-sm-12 d-flex justify-content-end align-items-center">
                                        <a href="{{route('admin.edit', ['id'=> $d->id])}}">
                                        <button class="btn btn-primary me-2 py-0">Edit</button>
                                        </a>

                                        <div class="p-1">
                                            <form action="{{ route('delete.ko', ['d_id' => $d->id])}}" method="post">
                                             @csrf
                                             @method('DELETE')

                                            <button type="submit"class="btn btn-danger py-0">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>


                          

                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
        <hr>
    </div>
    </body>
    @endforeach
@endsection