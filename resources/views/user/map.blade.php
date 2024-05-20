@extends('layouts.LOUser.app')
@section('content')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"/>
    <style>
         #map{
            height: 100vh;
            width: 100%;
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
    var map = L.map('map',{
        dragging: true 
    }).setView([18.4905,122.1285], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    }).addTo(map);
    
    map.setZoom(12);

    var grassMarker = L.marker([18.4599,122.1396]).addTo(map);
    grassMarker.bindPopup("<b>SEA GRASS</b>", { closeButton: false });

        // Add click event listener to the Maura marker
        grassMarker.on('click', function() {
            // Redirect to the specified route
             window.open("", "_blank");
        });

        // Add mouseover event listener to the Maura marker
        grassMarker.on('mouseover', function() {
            grassMarker.openPopup();
        });

        // Add mouseout event listener to the Maura marker
        grassMarker.on('mouseout', function() {
            grassMarker.closePopup();
        });

        //sample Eelgrass
        var grassMarker = L.marker([18.5169,122.1407]).addTo(map);
    grassMarker.bindPopup("<b>Eelgrass</b>", { closeButton: false });

        // Add click event listener to the Maura marker
        grassMarker.on('click', function() {
            // Redirect to the specified route
             window.open("", "_blank");
        });

        // Add mouseover event listener to the Maura marker
        grassMarker.on('mouseover', function() {
            grassMarker.openPopup();
        });

        // Add mouseout event listener to the Maura marker
        grassMarker.on('mouseout', function() {
            grassMarker.closePopup();
        });

         //sample Turtle grass
         var grassMarker = L.marker([18.5080,122.1482]).addTo(map);
    grassMarker.bindPopup("<b>Turtle Grass</b>", { closeButton: false });

        // Add click event listener to the Maura marker
        grassMarker.on('click', function() {
            // Redirect to the specified route
             window.open("", "_blank");
        });

        // Add mouseover event listener to the Maura marker
        grassMarker.on('mouseover', function() {
            grassMarker.openPopup();
        });

        // Add mouseout event listener to the Maura marker
        grassMarker.on('mouseout', function() {
            grassMarker.closePopup();
        });

 //sample Neptune grass
 var grassMarker = L.marker([18.4594,122.1390]).addTo(map);
    grassMarker.bindPopup("<b>Turtle Grass</b>", { closeButton: false });

        // Add click event listener to the Maura marker
        grassMarker.on('click', function() {
            // Redirect to the specified route
             window.open("", "_blank");
        });

        // Add mouseover event listener to the Maura marker
        grassMarker.on('mouseover', function() {
            grassMarker.openPopup();
        });

        // Add mouseout event listener to the Maura marker
        grassMarker.on('mouseout', function() {
            grassMarker.closePopup();
        });

</script>


@endsection