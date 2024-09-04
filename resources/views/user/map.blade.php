@extends('layouts.LOUser.app')
@section('content')
@php
$myEntry = DB::table('seaviews')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function($d) {
            // Ensure the photo URL is correctly generated
            $d->photo_url = asset('storage/' . $d->photo);
            return $d;
        });
@endphp

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
     #map {
        height: 100vh;
        width: 100%;
     }
     .popup-image {
        max-width: 80px; /* Adjust as needed */
        max-height: 100px; /* Adjust as needed */
        display: block;
        margin: 0 auto;
        
     }
</style>
</head>
<body>
    <div class="container">
        <div id="map"></div>
    </div>
</body>
</html>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    // Initialize the map
    var map = L.map('map').setView([18.4905, 122.1285], 13);

    // Add tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // Data from Blade
    var entries = @json($myEntry);

    // Add markers to the map
    entries.forEach(function(entry) {
        var popupContent = "<div>" +
            "<strong>Name:</strong> " + entry.name + " " + "<br>" +
            "<img src='" + entry.photo_url + "' class='popup-image' alt='Photo'>" +
            "</div>";

        L.marker([entry.lati, entry.longti])
            .addTo(map)
            .bindPopup(popupContent);
    });
</script>

@endsection
