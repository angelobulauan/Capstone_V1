<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea Grasses</title>
    <!-- Add Bootstrap CSS -->

</head>

<body>
    @extends('layouts.LOAdmin.app')
    @section('content')
        <div class="container-fluid mt-4">
            @foreach ($myEntry as $d)
    <div class="container mb-4">
        <div class="row">
            <div class="col-sm-12 p-2 shadow-sm">
                <div class="card h-auto">
                    <div class="row g-0">
                        <div class="col-sm-6 d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#imageSelectionModal-{{ $d->id }}">
                            <img src="{{ asset('storage/' . $d->photo) }}" alt="First Photo"
                                class="img-fluid w-50 h-50 object-fit-cover mx-auto d-block"
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
                                            <!-- other fields here -->

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
                        @foreach ($d->photos as $photo)  <!-- Access the photos directly -->
                            <form
                                action="{{ route('admin.update-photo', ['id' => $d->id, 'photo' => $photo->id]) }}"
                                class="update-photo-form" method="POST"
                                style="display: inline-block; margin-right: 10px;">
                                @csrf
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
@endforeach


            {{-- Pagination links --}}
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    {{ $myEntry->links() }} <!-- Adjust if you use a different pagination view -->
                </div>
            </div>
        </div> {{-- end of container --}}

        <script>
            $(document).ready(function() {
                // Handle form submission
                $('.update-photo-form').on('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission

                    const form = $(this);
                    const formData = new FormData(form[0]);

                    // Use AJAX to submit the form
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            Swal.fire('Success', 'Image updated successfully!', 'success').then(
                            () => {
                                    location
                                .reload(); // Reload the page after the success message
                                });
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'There was an error updating the image.', 'error');
                        }
                    });
                });
            });
        </script>
    @endsection
</body>

</html>
