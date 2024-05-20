@extends('layouts.LOAdmin.app')
@section('content')
<style>

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
                  <option value="Batu-Parada, Sta. Ana, Cagayan">Batu-Parada, Sta. Ana, Cagayan</option>
                  <option value="Casagan, Sta. Ana, Cagayan">Casagan, Sta. Ana, Cagayan</option>
                  <option value="Casambalangan, Sta. Ana, Cagayan">Casambalangan, Sta. Ana, Cagayan</option>
                  <option value="Centro, Sta. Ana, Cagayan">Centro, Sta. Ana, Cagayan</option>
                  <option value="Diora-Zinungan, Sta. Ana, Cagayan">Diora-Zinungan, Sta. Ana, Cagayan</option>
                  <option value="Dungeg , Sta. Ana, Cagayan">Dungeg , Sta. Ana, Cagayan</option>
                  <option value="Kapanikian, Sta. Ana, Cagayan">Kapanikian, Sta. Ana, Cagayan</option>
                  <option value="Marede, Sta. Ana, Cagaya">Marede, Sta. Ana, Cagayan</option>
                  <option value="Palawig, Sta. Ana, Cagayan">Palawig, Sta. Ana, Cagayan</option>
                  <option value="Patunungan, Sta. Ana, Cagayan">Patunungan, Sta. Ana, Cagayan</option>
                  <option value="Rapuli, Sta. Ana, Cagayan">Rapuli, Sta. Ana, Cagayan</option>
                  <option value="San Vicente, Sta. Ana, Cagayan">San Vicente, Sta. Ana, Cagayan</option>
                  <option value="Santa Clara, Sta. Ana, Cagayan">Santa Clara, Sta. Ana, Cagayan</option>
                  <option value="Santa Cruz, Sta. Ana, Cagayan">Santa Cruz, Sta. Ana, Cagayan</option>
                  <option value="Tangatan, Sta. Ana, Cagayan">Tangatan, Sta. Ana, Cagayan</option>
                  <option value="Visitacion, Sta. Ana, Cagayan">Visitacion, Sta. Ana, Cagayan</option>
                  <option value="Palaui Island, Sta. Ana, Cagayan">Palaui Island, Sta. Ana, Cagayan</option>

                </select>
              </div>
              <div class="col">
                <br>
                <label>Abundance</label>
                <input type="text" name="abundance" class="form-control" placeholder="Estimated Length" aria-label="">
              </div>
            </div>

            <div class="row mb-1 mt-1">
              <label for="file" class=" col-form-label">Upload Photo:</label>
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
