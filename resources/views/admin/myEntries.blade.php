@extends('layouts.LOAdmin.app')
@section('content')
    <div class="container-fluid mt-4">
        @foreach ($myEntry as $d)
            @php
                $selectphoto = DB::table('seagrasspics')
                    ->where('seagrasspics.sea_id', $d->id)
                    ->get();
                // dd($selectphoto);
            @endphp

            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <img src="{{ asset('storage/' . $d->photo) }}" alt="First Photo" class="img"
                            id="imageToSelect-{{ $d->id }}">
                        <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                            data-bs-target="#imageSelectionModal-{{ $d->id }}">
                            Update Image
                        </button>
                    </div>


                    <div class="col-sm-8">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 p-1">Name: {{ $d->name }}</div>
                                    <div class="col-sm-6 p-1">Scientific Name: {{ $d->scientificname }}</div>
                                    <div class="col-sm-6 p-1">
                                        <i class="fa fa-info-circle mr-2 text-primary"></i>Description:
                                        {{ $d->description }}
                                    </div>
                                    <div class="col-sm-6 p-1">
                                        <i class="fa fa-map-marker mr-2 text-warning"></i>Location: {{ $d->location }}
                                    </div>
                                    <div class="col-sm-6 p-1">
                                        <i class="fa fa-map-pin mr-2"></i>Abundance: {{ $d->abundance }}
                                    </div>

                                    <div class="col-sm-6 p-1">Created At: {{ $d->created_at }}</div>
                                    <div class="row mt-0">
                                        <!-- <div class="text-center"> -->
                                        <div class="col-sm-12 d-flex justify-content-end align-items-center">
                                            <a href="{{ route('admin.edit', ['id' => $d->id]) }}">
                                                <button class="btn btn-primary me-2 py-0">Edit</button>
                                            </a>

                                            <div class="p-1">
                                                <form action="{{ route('delete.ko', ['d_id' => $d->id]) }}" method="post"
                                                    class="selec">
                                                    @csrf @method('DELETE')

                                                    <button type="submit" class="btn btn-danger py-0">Remove</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <hr>
            </div>

            <!-- Modal for Image Selection -->
            <div class="modal fade" id="imageSelectionModal-{{ $d->id }}" tabindex="-1"
                aria-labelledby="imageSelectionModalLabel" data-bs-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageSelectionModalLabel">Select an Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="imageOptions">
                            <!-- Iterate through each photo fetched from the database -->
                            @foreach ($selectphoto as $photo)
                                <form action="{{ route('admin.update-photo', ['id' => $d->id, 'photo' => $photo->id]) }}"
                                    class="update-photo-form" method="POST"
                                    style="display: inline-block; margin-right: 10px;">
                                    <!-- CSRF token for form security -->
                                    @csrf
                                    @php
                                        // dd($photo);
                                    @endphp

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
        @endforeach
    </div> {{-- end of container --}}

    <!-- Script -->
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
                            // Reload the page to reflect the updated data
                            alert(response.message);

                            location.reload();
                        } else {
                            // Display error message
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error case
                        console.error("AJAX Error:", status, error);
                        alert("An error occurred. Please try again.");
                    }
                });
            });

            // Attach event listener for the photo button click to submit the form
            $('.photo-button').on('click', function() {
                var form = $(this).closest('.update-photo-form');
                form.submit();
            });
        });
    </script>
@endsection
