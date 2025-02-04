@extends('layouts.LOAdmin.app')
@section('content')
<link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">
    <div class="container-fluid mt-4">
        @foreach ($myEntry as $d)
            @php
                $selectphoto = DB::table('seagrasspics')
                    ->where('seagrasspics.sea_id', $d->id)
                    ->get();
            @endphp

            <div class="container mb-4">
                <div class="row">
                    <div class="col-sm-12 p-2 shadow-sm">
                        <div class="card h-auto">
                            <div class="row g-0">
                                <div class="col-sm-6 d-flex align-items-center" data-bs-toggle="modal"
                                    data-bs-target="#imageSelectionModal-{{ $d->id }}">
                                    <img src="{{ asset('storage/' . $d->photo) }}" alt="First Photo"
                                        class="img-fluid w-100 h-100 object-fit-cover"
                                        id="imageToSelect-{{ $d->id }}">
                                </div>

                                <div class="col-sm-6">
                                    <div class="card-body">
                                        <div class="row p-2 table-responsive">
                                            <table class="table table-striped border-collapse">
                                                <tbody>

                                                    <tr>
                                                        <th>Scientific Name 1</th>
                                                        <td>{{ $d->scientificname1 }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Scientific Name 2</th>
                                                        <td>{{ $d->scientificname2 }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Scientific Name 3</th>
                                                        <td>{{ $d->scientificname3 }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Description</th>
                                                        <td>{{ $d->description }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Location</th>
                                                        <td>{{ $d->location }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Latitude</th>
                                                        <td>{{ $d->latitude }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Longtitude</th>
                                                        <td>{{ $d->longtitude }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Author</th>
                                                        <td>{{ $d->updated_by }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th>Date Added</th>
                                                        <td>{{ date('F j, Y', strtotime($d->created_at)) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-sm-12 d-flex justify-content-end align-items-center">
                                                <button class="btn btn-primary me-2 py-0" data-bs-toggle="modal"
                                                    data-bs-target="#edit-entries-{{ $d->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form action="{{ route('admin.deleteseagrass', ['id' => $d->id]) }}"
                                                    method="get" class="selec">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-danger py-0">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Image Selection -->
                <div class="modal fade" id="imageSelectionModal-{{ $d->id }}" tabindex="-1"
                    aria-labelledby="imageSelectionModalLabel" data-bs-backdrop="static" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageSelectionModalLabel">Select an Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="imageOptions">
                                <!-- Iterate through each photo fetched from the database -->
                                @foreach ($selectphoto as $photo)
                                    <form
                                        action="{{ route('admin.update-photo', ['id' => $d->id, 'photo' => $photo->id]) }}"
                                        class="update-photo-form" method="POST"
                                        style="display: inline-block; margin-right: 10px;">
                                        <!-- CSRF token for form security -->
                                        @csrf
                                        <!-- Display the image using the path stored in the database -->
                                        <button type="submit" style="background: none; border: none; padding: 0;">
                                            <img src="{{ asset('storage/' . $photo->Photo) }}" alt="Photo"
                                                style="width: 125px; height: 125px; display: inline-block;">
                                        </button>
                                    </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal for editing entries --}}
            <div class="modal fade" id="edit-entries-{{ $d->id }}" tabindex="-1"
                aria-labelledby="centeredModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="centeredModalLabel">Edit entry {{ $d->scientificname1 }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="seagrassForm-{{ $d->id }}"
                                action="{{ route('admin.editseagrass', ['id' => $d->id]) }}" method="post">
                                @csrf

                                <div class="mb-2">
                                    <label for="scientificname1">Scientific Name 1:</label>
                                    <input type="text" id="scientificname1" name="scientificname1" class="form-control"
                                        value="{{ $d->scientificname1 }}">
                                </div>

                                <div class="mb-2">
                                    <label for="scientificname2">Scientific Name 2:</label>
                                    <input type="text" id="scientificname2" name="scientificname2" class="form-control"
                                        value="{{ $d->scientificname2 }}">
                                </div>

                                <div class="mb-2">
                                    <label for="scientificname3">Scientific Name 3:</label>
                                    <input type="text" id="scientificname3" name="scientificname3" class="form-control"
                                        value="{{ $d->scientificname3 }}">
                                </div>

                                <div class="mb-2">
                                    <label for="description">Description:</label>
                                    <input type="text" id="description" name="description" class="form-control"
                                        value="{{ $d->description }}">
                                </div>

                                <div class="mb-2">
                                    <label for="location">Location:</label>
                                    <input type="text" id="location" name="location" class="form-control"
                                        value="{{ $d->location }}">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div> {{-- end of container --}}
<!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    {{ $myEntry->links() }}
</div>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('.update-photo-form').on('submit', function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the form data
                var form = $(this);
                var actionUrl = form.attr('action');
                var formData = form.serialize(); // Serialize form data

                // Make the AJAX request
                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Handle successful response
                        if (response.success) {
                            // Display success message with Swal.fire
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location
                            .reload(); // Reload the page to reflect the updated data
                            });
                        } else {
                            // Display error message with Swal.fire
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error case with Swal.fire
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        console.error("AJAX Error:", status, error);
                    }
                });
            });

            // Attach event listener for the photo button click to submit the form
            $('.photo-button').on('click', function() {
                var form = $(this).closest('.update-photo-form');
                form.submit();
            });

            // Prefill the edit form if user will not enter a value and add ajax for the edit form submission
            $(document).ready(function () {
    $('form[id^="seagrassForm-"]').on('submit', function (event) {
        event.preventDefault();

        // Serialize form data
        var formData = new FormData(this);
        var actionUrl = $(this).attr('action');

        // AJAX request
        fetch(actionUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message || 'Something went wrong!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while saving.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.error('Error:', error);
            });
    });
});
            // Handle form submission for all forms with class 'selec'
            $(document).on('submit', '.selec', function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Get the form data
                var form = $(this);
                var actionUrl = form.attr('action');

                // Make the AJAX request
                $.ajax({
                    url: actionUrl,
                    type: 'GET',
                    data: form.serialize(), // Serialize form data
                    success: function(response) {
                        // Handle successful response
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            // Display error message
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error case
                        console.error("AJAX Error:", status, error);
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
@endsection
