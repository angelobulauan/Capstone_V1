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

        .custom-map-modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .modal-header,
        .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close {
            cursor: pointer;
            font-size: 1.5rem;
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
                                <input type="text" name="name" class="form-control" autocomplete="off"
                                    placeholder="Name of the Sea Grass" required>
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="scientificname" class="form-label">Scientific Name</label>
                                <input type="text" name="scientificname" class="form-control" autocomplete="off"
                                    placeholder="Scientific Name of the Sea Grass"required>
                            </div>
                            <br>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" autocomplete="off"
                                    placeholder="Describe the look and texture" required></textarea>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <label>Barangay, Town, Province</label>
                                    <input type="text" name="location" class="form-control" autocomplete="off"
                                        placeholder="Enter the Location"required>
                                </div>
                                <div class="col">
                                    <br>
                                    <label>Abundance</label>
                                    <input type="text" name="abundance" class="form-control" autocomplete="off"
                                        placeholder="Estimated Length" required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-5">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude"
                                        autocomplete="off" placeholder="Enter latitude" required>
                                </div>
                                <div class="col-6">
                                    <label for="longtitude" class="form-label">Longtitude</label>
                                    <input type="text" class="form-control" name="longtitude" id="longtitude"
                                        autocomplete="off" placeholder="Enter longtitude" required>
                                </div>
                                <div class="col-1 d-flex align-items-center mt-4">
                                    <button id="openModal" type="button" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-crosshair" viewBox="0 0 16 16">
                                            <path
                                                d="M8.5.5a.5.5 0 0 0-1 0v.518A7 7 0 0 0 1.018 7.5H.5a.5.5 0 0 0 0 1h.518A7 7 0 0 0 7.5 14.982v.518a.5.5 0 0 0 1 0v-.518A7 7 0 0 0 14.982 8.5h.518a.5.5 0 0 0 0-1h-.518A7 7 0 0 0 8.5 1.018zm-6.48 7A6 6 0 0 1 7.5 2.02v.48a.5.5 0 0 0 1 0v-.48a6 6 0 0 1 5.48 5.48h-.48a.5.5 0 0 0 0 1h.48a6 6 0 0 1-5.48 5.48v-.48a.5.5 0 0 0-1 0v.48A6 6 0 0 1 2.02 8.5h.48a.5.5 0 0 0 0-1zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                        </svg>
                                    </button>
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
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div id="exampleModal" class="custom-map-modal" style="display:none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Map Location</h5>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <!-- Map container -->
                    <div id="map" style="height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveLocation">Save Location</button>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
        <script>
            $(document).ready(function() {
                let map;
                let marker;

                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: 18.4816,
                        lng: 122.1557
                    },
                    zoom: 13
                });

                marker = new google.maps.Marker({
                    position: {
                        lat: 18.4816,
                        lng: 122.1557
                    },
                    map: map,
                    draggable: true
                });

                $('#openModal').on('click', function() {
                    $('#exampleModal').fadeIn();
                    setTimeout(function() {
                        google.maps.event.trigger(map, 'resize');
                        map.setCenter(marker.getPosition());
                    }, 100);
                });

                $('.close, #closeModal').on('click', function() {
                    $('#exampleModal').fadeOut();
                });

                $('#saveLocation').on('click', function() {
                    const lat = marker.getPosition().lat();
                    const lng = marker.getPosition().lng();
                    $('input[name="latitude"]').val(lat.toFixed(6));
                    $('input[name="longtitude"]').val(lng.toFixed(6));
                    $('#exampleModal').fadeOut();
                });

                // for the submission
                $('#seagrassForm').on('submit', function(e) {
                    e.preventDefault();

                    let formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('admin.addNew') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }).then(function() {
                                window.location.href = "{{ route('admin.add.index') }}";
                            });
                        },
                        error: function(response) {
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
