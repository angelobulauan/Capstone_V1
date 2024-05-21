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

<form id="seagrassForm" enctype="multipart/form-data" method="post">
    @csrf

    <div class="container">
        <div style="padding:10px;">
            <div class="card-header">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" autocomplete="off" placeholder="Name of the Sea Grass">
                    </div>
                    <br>
                    <div class="col-md-6">
                        <label for="scientificname" class="form-label">Scientific Name</label>
                        <input type="text" name="scientificname" class="form-control" autocomplete="off" placeholder="Scientific Name of the Sea Grass">
                    </div>
                    <br>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Describe the look and texture"></textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <br>
                            <label>Location</label>
                            <select class="form-select" name="location">
                                <option hidden>Select Location</option>
                                <!-- Options here -->
                                <option value="Batu-Parada, Sta. Ana, Cagayan">Batu-Parada, Sta. Ana, Cagayan</option>
                                <option value="Casagan, Sta. Ana, Cagayan">Casagan, Sta. Ana, Cagayan</option>
                                <!-- Add the rest of the options -->
                            </select>
                        </div>
                        <div class="col">
                            <br>
                            <label>Abundance</label>
                            <input type="text" name="abundance" class="form-control" placeholder="Estimated Length">
                        </div>
                    </div>

                    <div class="row mb-1 mt-1">
                        <label for="photo" class="col-form-label">Upload Photo:</label>
                        <span class="text-danger small">Include a maximum of 3 files/photos.</span>
                        <div class="col-sm-7">
                            <input type="file" name="photo[]" class="form-control border" required multiple>
                        </div>
                    </div>
                    <div class="col-12">
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function () {
    $('#seagrassForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.addNew') }}",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                }).then(function () {
                    window.location.href = "{{ route('admin.add.index') }}";
                });
            },
            error: function (response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.responseJSON.message,
                });
            }
        });
    });
});
</script>

</body>
@endsection
