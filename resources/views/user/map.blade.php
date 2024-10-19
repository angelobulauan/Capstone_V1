<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea Grass Map</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    @extends('layouts.LOUser.app')
    @section('content')
        @php
            $myEntry = DB::table('seaviews')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($d) {
                    $d->photo_url = asset('storage/' . $d->photo);
                    return $d;
                });
        @endphp

        <style>
            #map {
                height: 90vh;
                width: 100%;
            }

            .popup-image {
                max-width: 100%;
                height: auto;
                display: block;
                margin: 0 auto;
            }

            /* Modal styling for desktop */
            .modal-dialog {
                max-width: 60%;
                margin: 30px auto;
            }

            /* Modal styling for mobile */
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
        </style>

        <div class="container-fluid mt-3">
            <div id="map"></div>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <script>
            function initMap() {
                var mapOptions = {
                    center: {
                        lat: 18.4905,
                        lng: 122.1285
                    },
                    zoom: 13
                };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                var entries = @json($myEntry);

                entries.forEach(function(entry) {
                    var marker = new google.maps.Marker({
                        position: {
                            lat: parseFloat(entry.lati),
                            lng: parseFloat(entry.longti)
                        },
                        map: map,
                    });

                    var contentString = "<div class='modal-content'>" +
                        "<div class='modal-header'>" +
                        "<h5 class='modal-title'>" + entry.name + "</h5>" +
                        "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
                        "<span aria-hidden='true'>&times;</span>" +
                        "</button>" +
                        "</div>" +
                        "<div class='modal-body'>" +
                            "<img src='" + entry.photo_url + "' class='popup-image' />" +
                        "<p><strong>Scientific Name:</strong> " + entry.scientificname + "</p>" +
                        "<p><strong>Location:</strong> " + entry.location + "</p>" +
                        "<p><strong>Abundance:</strong> " + entry.abundance + "</p>" +

                        "</div>" +
                        "</div>";

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    marker.addListener('click', function() {
                        $('#mapModal').modal('show');
                        $('.modal-content').html(contentString);
                    });
                });
            }

            window.onload = initMap;
        </script>

        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                </div>
            </div>
        </div>
    @endsection

</body>

</html>
