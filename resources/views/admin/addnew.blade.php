
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Sea Grass</title>
    <link rel="shortcut icon" href="{{asset('favicon.png') }}">
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
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
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
</head>
<body>
    @extends('layouts.LOAdmin.app')

    @section('content')
    <form id="seagrassForm" action="{{ route('admin.addNew.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div style="padding:10px;">
                    <div class="card-header">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="scientificname" class="form-label">Scientific Name 1</label>
                                <input type="text" name="scientificname1" class="form-control" autocomplete="off" placeholder="Scientific Name of the Sea Grass">
                            </div>
                            <div class="col-md-6">
                                <label for="scientificname" class="form-label">Scientific Name 2</label>
                                <input type="text" name="scientificname2" class="form-control" autocomplete="off" placeholder="Scientific Name of the Sea Grass">
                            </div>
                            <div class="col-md-6">
                                <label for="scientificname" class="form-label">Scientific Name 3</label>
                                <input type="text" name="scientificname3" class="form-control" autocomplete="off" placeholder="Scientific Name of the Sea Grass">
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" rows="3" autocomplete="off" placeholder="Describe the Location"></textarea>
                            </div>
                            <span></span>
                            <div class="row">
                                <div class="col">
                                    <label>Barangay, Town, Province</label>
                                    <input type="text" name="location" class="form-control" autocomplete="off" placeholder="Enter the Location" required>
                                </div>
                            </div>

                            <div class="row mt-3 d-flex align-items-center">
                                <div class="col-5">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude"
                                        autocomplete="off" placeholder="Enter Latitude" required>
                                </div>
                                <div class="col-6">
                                    <label for="longtitude" class="form-label">Longtitude</label>
                                    <input type="text" class="form-control" name="longtitude" id="longtitude"
                                        autocomplete="off" placeholder="Enter Longtitude" required>
                                </div>

                                <div class="col-1 d-flex align-items-center mt-4">
                                    <button id="openModalMapLocationAdmin" type="button" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-crosshair" viewBox="0 0 16 16">
                                            <path
                                                d="M8.5.5a.5.5 0 0 0-1 0v.518A7 7 0 0 0 1.018 7.5H.5a.5.5 0 0 0 0 1h.518A7 7 0 0 0 7.5 14.982v.518a.5.5 0 0 0 1 0v-.518A7 7 0 0 0 14.982 8.5h.518a.5.5 0 0 0 0-1h-.518A7 7 0 0 0 8.5 1.018zm-6.48 7A6 6 0 0 1 7.5 2.02v.48a.5.5 0 0 0 1 0v-.48a6 6 0 0 1 5.48 5.48h-.48a.5.5 0 0 0 0 1h.48a6 6 0 0 1-5.48 5.48v-.48a.5.5 0 0 0-1 0v.48A6 6 0 0 1 2.02 8.5h.48a.5.5 0 0 0 0-1zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                        </svg>
                                    </button>
                                </div>


                            </div>

                            <div class="modal fade" id="mapModalAdmin" tabindex="-1" aria-labelledby="mapModalAdminLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mapModalAdminLabel">Add Location</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="mapAdmin" style="height: 400px;"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                var mapAdmin;
                                var markerAdmin;
                                var myLatlngAdmin = {
                                    lat: 18.4905,
                                    lng: 122.1285
                                };

                                function initMapAdmin() {
                                    mapAdmin = new google.maps.Map(document.getElementById("mapAdmin"), {
                                        center: myLatlngAdmin,
                                        zoom: 13,
                                    });

                                    markerAdmin = new google.maps.Marker({
                                        position: myLatlngAdmin,
                                        map: mapAdmin,
                                        draggable: true,
                                    });

                                    google.maps.event.addListener(markerAdmin, 'dragend',
                                        function() {
                                            var latLng = markerAdmin.getPosition();
                                            document.getElementById("latitude").value = latLng
                                                .lat();
                                            document.getElementById("longtitude").value = latLng
                                                .lng();
                                        });
                                }

                                window.onload = initMapAdmin;

                                document.getElementById("openModalMapLocationAdmin")
                                    .addEventListener("click", function() {
                                        var modal = new bootstrap.Modal(document.getElementById("mapModalAdmin"));
                                        modal.show();
                                    });
                            </script>

                            {{-- <div class="row mt-3 d-flex align-items-center">
                                <div class="col-md-6">
                                    <label for="color" class="form-label">Polygon Color</label>
                                    <input type="color" name="color" class="form-control" value="#FF0000" required>
                                </div>
                                <div class="col-auto">
                                    <p>Press This to add Sea GrassLocation:</p>
                                </div>
                                <div class="col-auto">
                                    <button id="openModal" type="button" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-crosshair" viewBox="0 0 16 16">
                                            <path d="M8.5.5a.5.5 0 0 0-1 0v.518A7 7 0 0 0 1.018 7.5H.5a.5.5 0 0 0 0 1h.518A7 7 0 0 0 7.5 14.982v.518a.5.5 0 0 0 1 0v-.518A7 7 0 0 0 14.982 8.5h.518a.5.5 0 0 0 0-1h-.518A7 7 0 0 0 8.5 1.018zm-6.48 7A6 6 0 0 1 7.5 2.02v.48a.5.5 0 0 0 1 0v-.48a6 6 0 0 1 5.48 5.48h-.48a.5.5 0 0 0 0 1h.48a6 6 0 0 1-5.48 5.48v-.48a.5.5 0 0 0-1 0v.48A6 6 0 0 1 2.02 8.5h.48a.5.5 0 0 0 0-1zM8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                        </svg>
                                    </button>
                                </div>
                            </div> --}}

                            <div class="row mb-1 mt-1">
                                <label for="photo" class="col-form-label">Upload Photo:</label>
                                <span class="text-danger small">Include a maximum of 3 files/photos.</span>
                                <div class="col-sm-7">
                                    <input type="file" name="photo[]" class="form-control border" required multiple>
                                </div>
                            </div>

                            {{-- <input type="hidden" id="polygonCoordinates" name="polygon_coordinates"> --}}

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- <div id="exampleModal" class="custom-map-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Map Location</h5>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                </div>
            </div>
        </div> --}}

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=drawing"></script>
    {{-- <script>
        $(document).ready(function () {
            let map;
            let drawingManager;
            let selectedPolygon;

            // Initialize the map
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 18.4816, lng: 122.1557 },
                zoom: 13
            });

            // Initialize the drawing manager for drawing polygons
            drawingManager = new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: ['polygon']
                },
                polygonOptions: {
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    strokeWeight: 2,
                    clickable: true,
                    editable: true,
                    draggable: false
                }
            });

            // Add drawing manager to the map
            drawingManager.setMap(map);

            // Event listener for when a polygon is completed
            // Event listener for when a polygon is completed
    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
        // Remove the previous polygon if it exists
        if (selectedPolygon) {
            selectedPolygon.setMap(null);
        }
        selectedPolygon = polygon;

        // Get the selected color from the color picker
        const selectedColor = $('input[name="polygon_color"]').val(); // Change 'color' to 'polygon_color'

        // Set the polygon's fill and stroke colors
        polygon.setOptions({
            fillColor: selectedColor,
            strokeColor: selectedColor
        });

        // Get the coordinates of the completed polygon
        const polygonPath = polygon.getPath();
        let coordinates = [];
        polygonPath.forEach(function (latLng) {
            coordinates.push({
                lat: latLng.lat(),
                lng: latLng.lng()
            });
        });

        // Store the coordinates as a JSON string
        $('#polygonCoordinates').val(JSON.stringify(coordinates));
    });


            // Open the modal
            $('#openModal').on('click', function () {
                $('#exampleModal').fadeIn();
            });

            // Close the modal
            $('.close, #closeModal').on('click', function () {
                $('#exampleModal').fadeOut();
                if (selectedPolygon) {
                    selectedPolygon.setMap(null); // Clear polygon when closing modal
                    selectedPolygon = null; // Reset the selected polygon
                }
            });

            // Handle form submission with AJAX
            $('#seagrassForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                const coordinates = $('#polygonCoordinates').val(); // Get the polygon coordinates
                if (!coordinates) {
                    alert('Please draw a polygon before saving!');
                    return;
                }

                const formData = new FormData(this); // Create FormData object to hold form data
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting content type
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Data saved successfully!',
                        });
                        // Reset the form fields and close modal
                        $('#seagrassForm')[0].reset();
                        $('#exampleModal').fadeOut();
                        if (selectedPolygon) {
                            selectedPolygon.setMap(null); // Clear polygon after saving
                            selectedPolygon = null; // Reset the selected polygon
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to save data. Please try again.',
                        });
                    }
                });
            });
        });
    </script> --}}
     {{-- @else
     <div class="container h-screen flex justify-center items-center">
         <div class="w-1/2 bg-white rounded-lg shadow-lg p-8">
             <div class="flex items-center justify-center">
                 <i class="fas fa-lock text-red-500" style="font-size: 3rem;"></i>
             </div>
             <h2 class="text-2xl font-bold text-center">ACCESS LOCKED</h2>
             <p class="text-gray-600 text-center">PLEASE WAIT FOR AN ADMINISTRATOR TO VERIFY YOUR IDENTITY</p>
             <p class="text-gray-600 text-center"><i>Note: Please update your profile information to provide a valid Identification</i></p>
             <div class="flex items-center justify-center">
                 <a href="{{ route('profile.edit') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4 no-underline">
                     <i class="fas fa-arrow-circle-right"></i> Go to Profile
                 </a>
             </div>
         </div>
     @endif --}}

    @endsection

</body>
</html>


