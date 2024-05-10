@extends('layouts.LOAdmin.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


{{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
  .body {
    background-image: url('img/bg.jpg');
  }

  .container input {
    border-radius: 50px;
  }

  .form-select {
    border-radius: 50px;

  }

  .container label {
    font-family: Arial, Helvetica, sans-serif;
    font-style: italic;
  }
</style>

<body>

  <form action="{{route('admin.addNew')}}" method="GET">
    @csrf
    
    <div class="container">
      <div class="" style="padding:10px;">
        <div class="card-header ">
          <form class="row g-3">
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Name of the Sea Grass">
            </div>
            <br>
            <div class="col-md-6">
              <label for="inputEmail4" class="form-label"> Scientific Name</label>
              <input type="text" name="scientificname" class="form-control" autocomplete="off" placeholder=" Scientific Name of the Sea Grass">
            </div>
            <br>
            <div class="col-12">
              <label for="exampleFormControlTextarea1" class="form-label">Description</label>
              <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Describe the look and texture"></textarea>
            </div>
            <div class="row">
              <div class="col">
                <br>
                <label>Location</label>
                <select class="form-select" aria-label="Default select example " name="location">
                  <option Hidden>Select Location</option>
                  <option value="Sta. Ana">Batu-Parada, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Casagan, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Casambalangan, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Centro, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Diora-Zinungan, Sta. Ana, Cagayan</option> 
                  <option value="Sta. Ana">Dungeg , Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Kapanikian, Sta. Ana, Cagayan</option>  
                  <option value="Sta. Ana">Marede, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Palawig, Sta. Ana, Cagayan</option>              
                  <option value="Sta. Ana">Patunungan, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Rapuli, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">San Vicente, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Santa Clara, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Santa Cruz, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Tangatan, Sta. Ana, Cagayan</option>
                  <option value="Sta. Ana">Visitacion, Sta. Ana, Cagayan</option>
                  
                </select>
              </div>
              <div class="col">
                <br>
                <label>Abundace</label>
                <input type="text" name="abundance" class="form-control" placeholder="Estimated Length" aria-label="">
              </div>
            </div>

            <div class="row mb-1 mt-1">
              <label for="file" class=" col-form-label">Upload File:</label>
              <div class="col-sm-7">
                <input type="file" name="photo" id="" class="form-control border" required>
              </div>
            </div>
            <div class="col-12">
              <br>
              <input type="submit" value="Add now" name="save" class="btn btn-primary">

            </div> 

          </form>
        </div>
      </div>
    </div>
    </div>
  </form>


</body>


@endsection