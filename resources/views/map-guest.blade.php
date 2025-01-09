<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea Grass Map</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>

        body {
            background-color: #f4f4f9;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #333;
            z-index: 3;
            display: flex;
            justify-content: center;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        #map {
            height: 90vh;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .popup-image {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 10px;
        }

        .modal-dialog {
            max-width: 60%;
            margin: 30px auto;
        }

        @media (max-width: 767px) {
            .modal-dialog {
                max-width: 95%;
                margin: 10px auto;
            }

            .modal-content {
                width: 100%;
                height: auto;
            }

            #map {
                height: 80vh;
            }
        }

        .input-group {
            background-color: #f8f9fa;
            border-radius: 30px;
            overflow: hidden;
        }

        .input-group .form-control {
            border: 2px solid #ccc;
            border-radius: 30px 0 0 30px;
            padding: 12px 20px;
            font-size: 16px;
        }

        .input-group-append .btn {
            border: 2px solid #ccc;
            border-left: none;
            border-radius: 0 30px 30px 0;
            padding: 12px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
        }

        .input-group-append .btn:hover {
            background-color: #218838;
            color: white;
        }

        .form-control::placeholder {
            color: #6c757d;
        }

        .container-fluid {
            margin-top: 30px;
        }

        .modal-header {
            background-color: #28a745;
            color: white;
        }

        .modal-title {
            font-size: 1.5rem;
        }

        .table {
            margin-top: 20px;
        }

        .table td {
            vertical-align: middle;
        }

        .table-info {
            background-color: #e9f7ef;
        }

        .table-light {
            background-color: #f8f9fa;
        }


    </style>
</head>

<body>

    @extends('layouts.app')
        @php
            $myEntry = DB::table('seaviews')
                ->where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($d) {
                    $d->photo_url = asset('storage/' . $d->photo);
                    return $d;
                });
        @endphp
<div class="navbar">
    <a href="/">Home</a>
    {{-- <a href="{{ route('map-guest') }}">Map</a> --}}
    <a href="/#article">Article</a>
    <a href="/#contact">Contact Us</a>
</div>
        <!-- Search Bar -->
                       <div class="container-fluid" style="margin-top: 100px;">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6">
                            <div class="input-group mb-3 shadow-sm rounded">
                                <input type="text" class="form-control border-secondary" id="searchBar" placeholder="Search by Name or Location"
                                    aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success rounded-end" type="button" id="searchButton">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        <div class="container-fluid mt-3">
            <div id="map"></div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

        <script>
            let markers = [];
            let map;

            function initMap() {
                var mapOptions = {
                    center: {
                        lat: 18.4905,
                        lng: 122.1285
                    },
                    zoom: 13
                };

                map = new google.maps.Map(document.getElementById('map'), mapOptions);

                var entries = @json($myEntry);

                entries.forEach(function (entry) {
                    var marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(entry.latitude),
                            lng: parseFloat(entry.longtitude)
                        },
                        map: map,
                        title: entry.scientificname1,
                    });

                    markers.push({
                        marker: marker,
                        entry: entry
                    });

                    var contentString =
                        "<div class='modal-content'>" +
                        "<div class='modal-header'>" +
                        "<h5 class='modal-title'><i class='fas fa-leaf'></i> Sea Grass</h5>" +
                        "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>" +
                        "</div>" +
                        "<div class='modal-body'>" +
                        "<div class='text-center mb-4'>" +
                        "<img src='" + entry.photo_url + "' class='popup-image img-fluid w-50 h-50 object-fit-cover mx-auto d-block' />" +
                        "</div>" +
                        "<table class='table table-bordered table-striped'>" +
                        "<tr class='table-info'><td><i class='fas fa-leaf text-success'></i> <strong>Scientific Name 1:</strong></td><td>" + entry.scientificname1 + "</td></tr>" +
                        "<tr class='table-light'><td><i class='fas fa-leaf text-success'></i> <strong>Scientific Name 2:</strong></td><td>" + entry.scientificname2 + "</td></tr>" +
                        "<tr class='table-info'><td><i class='fas fa-leaf text-success'></i> <strong>Scientific Name 3:</strong></td><td>" + entry.scientificname3 + "</td></tr>" +
                        "<tr class='table-light'><td><i class='fas fa-info-circle text-primary'></i> <strong>Description:</strong></td><td>" + entry.description + "</td></tr>" +
                        "<tr class='table-info'><td><i class='fas fa-map-marker-alt text-warning'></i> <strong>Location:</strong></td><td>" + entry.location + "</td></tr>" +
                        "<tr class='table-light'><td><i class='fas fa-globe text-info'></i> <strong>Latitude & Longitude:</strong></td><td>" + entry.latitude + " : " + entry.longtitude + "</td></tr>" +
                        "<tr class='table-info'><td><i class='fas fa-user text-dark'></i> <strong>Author:</strong></td><td>" + entry.updated_by + "</td></tr>" +
                        "</table>" +
                        "</div>" +
                        "</div>";

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    marker.addListener('click', function () {
                        $('#mapModal').modal('show');
                        $('.modal-content').html(contentString);
                    });
                });
            }

            // Function to filter markers based on the search input
            function filterMarkers() {
                var query = $('#searchBar').val().toLowerCase();
                markers.forEach(function (item) {
                    var marker = item.marker;
                    var entry = item.entry;
                    var match = entry.scientificname1.toLowerCase().includes(query) || entry.location.toLowerCase().includes(query);

                    if (match) {
                        marker.setMap(map);
                    } else {
                        marker.setMap(null);
                    }
                });
            }

            // Trigger the filter function when the user types in the search bar
            $('#searchBar').on('keyup', function () {
                filterMarkers();
            });

            window.onload = initMap;
        </script>

        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                </div>
            </div>
        </div>
</body>

</html>
