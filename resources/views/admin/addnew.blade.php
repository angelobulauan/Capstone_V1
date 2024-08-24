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
                                    placeholder="Name of the Sea Grass">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="scientificname" class="form-label">Scientific Name</label>
                                <input type="text" name="scientificname" class="form-control" autocomplete="off"
                                    placeholder="Scientific Name of the Sea Grass">
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
                                        <option value="Batu-Parada, Sta. Ana, Cagayan">Batu-Parada, Sta. Ana, Cagayan
                                        </option>
                                        <option value="Casagan, Sta. Ana, Cagayan">Casagan, Sta. Ana, Cagayan</option>
                                        <!-- Add the rest of the options -->
                                    </select>
                                </div>
                                <div class="col">
                                    <br>
                                    <label>Abundance</label>
                                    <input type="text" name="abundance" class="form-control"
                                        placeholder="Estimated Length">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-5">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude"
                                        placeholder="Enter latitude" required>
                                </div>
                                <div class="col-6">
                                    <label for="longtitude" class="form-label">Longtitude</label>
                                    <input type="text" class="form-control" name="longtitude" id="longtitude"
                                        placeholder="Enter longtitude" required>
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
                                <button type="submit" class="btn btn-primary">Save</button>
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
        <script>
            $(document).ready(function() {
                // for the modal
                let map;
                let marker;

                const locations = {
                    "Batu-Parada, Sta. Ana, Cagayan": {
                        lat: 18.4650,
                        lng: 122.1450
                    },
                    "Casagan, Sta. Ana, Cagayan": {
                        lat: 18.4595,
                        lng: 122.1300
                    }
                };

                // Initialize the map
                map = L.map('map').setView([18.4816, 122.1557], 13);

                // Add a tile layer to the map (using OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                }).addTo(map);

                // Initialize the marker and add it to the map
                marker = L.marker([18.4816, 122.1557], {
                    draggable: true
                }).addTo(map);

                // Open the modal and invalidate the map size
                $('#openModal').on('click', function() {
                    $('#exampleModal').fadeIn();
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 100);
                });

                // Close the modal
                $('.close, #closeModal').on('click', function() {
                    $('#exampleModal').fadeOut();
                });

                // Close the modal when clicking outside the modal content
                $(window).on('click', function(event) {
                    if ($(event.target).is('#exampleModal')) {
                        $('#exampleModal').fadeOut();
                    }
                });

                // Save the selected coordinates when "Save Location" is clicked
                $('#saveLocation').on('click', function() {
                    const lat = marker.getLatLng().lat.toFixed(6);
                    const lng = marker.getLatLng().lng.toFixed(6);
                    $('input[name="latitude"]').val(lat);
                    $('input[name="longtitude"]').val(lng);
                    $('#exampleModal').fadeOut();
                });

                // Update map when a location is selected
                $('select[name="location"]').on('change', function() {
                    const selectedLocation = $(this).val();
                    const coordinates = locations[selectedLocation];

                    if (coordinates) {
                        map.setView([coordinates.lat, coordinates.lng], 13);
                        marker.setLatLng([coordinates.lat, coordinates.lng]);
                        $('input[name="latitude"]').val(coordinates.lat.toFixed(6));
                        $('input[name="longtitude"]').val(coordinates.lng.toFixed(6));
                    }
                });
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
        </script>

    </body>
@endsection
