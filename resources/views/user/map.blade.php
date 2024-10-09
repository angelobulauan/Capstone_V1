@extends('layouts.LOUser.app')
@section('content')
@php
$myEntry = DB::table('seaviews')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($d) {
            $d->photo_url = asset('storage/' . $d->photo);
            return $d;
        });
@endphp

<style>
     #map {
        height: 100vh;
        width: 100%;
     }
     .popup-image {
        max-width: 80px;
        max-height: 100px;
        display: block;
        margin: 0 auto;
     }
</style>

<div class="container-fluid">
    <div id="map"></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
<script>
    function initMap() {
        var mapOptions = {
            center: { lat: 18.4905, lng: 122.1285 },
            zoom: 13
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var entries = @json($myEntry);

        entries.forEach(function(entry) {
            var marker = new google.maps.Marker({
                position: { lat: parseFloat(entry.lati), lng: parseFloat(entry.longti) },
                map: map,
            });

            var contentString = "<div>" +
                "<strong>Name:</strong> " + entry.name + "<br>" +
                "<img src='" + entry.photo_url + "' class='popup-image' alt='Photo'>" +
                "</div>";

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        });
    }

    window.onload = initMap;
</script>

@endsection
