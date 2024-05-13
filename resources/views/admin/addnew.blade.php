@extends('layouts.LOAdmin.app')
@section('content')
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

    <form action="{{ route('admin.addNew') }}" method="POST" enctype="multipart/form-data">
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
              <span class="text-danger small" style="">Include a maximum of 3 files/photos.</span>
              <div class="col-sm-7">
                <input type="file" name="photo[]" id="" class="form-control border" required multiple>
              </div>
            </div>
            <div class="col-12">
              <br>
              <button type="submit" value="Add now" class="btn btn-primary">Save</button>

            </div>

          </form>
        </div>
      </div>
    </div>
    </div>
  </form>


</body>


@endsection
