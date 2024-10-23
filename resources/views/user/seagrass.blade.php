<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea Grasses</title>
</head>

<body>
    @extends('layouts.LOUser.app')

    @section('content')
        <div class="container mt-3">
            <!-- Search Form -->
            <form action="{{ route('user.seagrass.search') }}" method="GET" class="form-inline mb-3">
                <div class="input-group">
                    <input type="text" name="query" class="form-control form-control-sm"
                        placeholder="Search by name or location" value="{{ request()->input('query') }}"
                        style="width: 50px;">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- If no results found -->
        @if ($myEntry->isEmpty())
            <p class="text-center">No Data Entry Published!</p>
        @else
            @foreach ($myEntry as $d)
                @php
                    $interactions = DB::table('sea_grass_likes')
                        ->select(
                            'seaviews_id',
                            DB::raw('SUM(likes) as total_likes'),
                            DB::raw('SUM(dislikes) as total_dislikes'),
                            DB::raw('SUM(views) as total_views'),
                        )
                        ->groupBy('seaviews_id')
                        ->get();
                @endphp
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="{{ asset('storage/' . $d->photo) }}" alt="Seagrass Photo"
                                class="img-fluid rounded shadow-sm" id="imageToSelect-{{ $d->id }}">
                        </div>

                        <div class="col-sm-9">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6 p-1">
                                            <i class="fa fa-leaf text-success"></i> Name: {{ $d->name }}
                                        </div>

                                        <div class="col-sm-6 p-1">
                                            <i class="fa fa-microscope  text-secondary"></i> Scientific Name: {{ $d->scientificname }}
                                        </div>

                                        <div class="col-sm-6 p-1">
                                            <i class="fa fa-info-circle mr-2 text-primary"></i>Description:
                                            {{ $d->description }}
                                        </div>
                                        <div class="col-sm-6 p-1">
                                            <i class="fa fa-map-marker-alt mr-2 text-warning"></i>Location: {{ $d->location }}
                                        </div>
                                        <div class="col-sm-6 p-1">
                                            <i class="fa fa-map-pin mr-2"></i>Abundance: {{ $d->abundance }}
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-sm-3 d-flex justify-content-start align-items-center">
                                                <button type="button" class="btn btn-primary viewMapBtn"
                                                    data-id="{{ $d->id }}"
                                                    data-coordinates="{{ $d->polygon_coordinates }}">
                                                    View Location
                                                </button>
                                            </div>
                                            <div class="col-sm-9 d-flex justify-content-end align-items-center">
                                                <a href="javascript:void(0);" class="p-4 likeBtn"
                                                    data-id="{{ $d->id }}" style="text-decoration: none;">
                                                    <i class="fas fa fa-thumbs-up fa-2x text-blue-500"></i>
                                                    <span
                                                        id="like-count-{{ $d->id }}">{{ $interactions->firstWhere('seaviews_id', $d->id)->total_likes ?? 0 }}</span>
                                                </a>
                                                <a href="javascript:void(0);" class="dislikeBtn"
                                                    data-id="{{ $d->id }}" style="text-decoration: none;">
                                                    <i class="fas fa fa-thumbs-down fa-2x text-red-500"></i>
                                                    <span
                                                        id="dislike-count-{{ $d->id }}">{{ $interactions->firstWhere('seaviews_id', $d->id)->total_dislikes ?? 0 }}</span>
                                                </a>
                                                <p class="text-danger pl-4 mt-4">
                                                    <span
                                                        id="view-count-{{ $d->id }}">{{ $interactions->firstWhere('seaviews_id', $d->id)->total_views ?? 0 }}</span>
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>

                <!-- Map Modal -->
                <div class="modal mapCont" id="mapModal-{{ $d->id }}" tabindex="-1" role="dialog"
                    style="display:none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Map Location</h5>
                                <button type="button" class="close closeMapModalBtn" data-id="{{ $d->id }}"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body bg-slate-200">
                                <div id="map-{{ $d->id }}" style="height: 400px;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary closeMapModalBtn"
                                    data-id="{{ $d->id }}">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $myEntry->links() }}
            </div>
        @endif

        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
        <script>
            document.querySelectorAll('.viewMapBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const entryId = this.dataset.id;
                    const coordinates = JSON.parse(this.dataset.coordinates);
                    const mapModal = document.getElementById('mapModal-' + entryId);
                    mapModal.style.display = 'block';

                    // Update the view count via AJAX
                    $.ajax({
                        url: '/user/updateView/' + entryId,
                        type: 'GET',
                        success: function(response) {
                            if (response && response.views !== undefined) {
                                $('#view-count-' + entryId).text(response.views);
                            }
                        },
                        error: function(xhr) {
                            console.log('AJAX error:', xhr.responseText);
                        }
                    });

                    const mapElement = document.getElementById('map-' + entryId);

                    // Check if the map is already initialized
                    if (!mapElement.dataset.initialized) {
                        const map = new google.maps.Map(mapElement, {
                            zoom: 12,
                            center: coordinates[0] // Center map on the first coordinate
                        });

                        // Draw the polygon
                        const polygon = new google.maps.Polygon({
                            paths: coordinates,
                            strokeColor: '#FF0000',
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: '#FF0000',
                            fillOpacity: 0.35
                        });
                        polygon.setMap(map);

                        // Mark the map as initialized
                        mapElement.dataset.initialized = 'true';
                    }
                });
            });


            document.querySelectorAll('.closeMapModalBtn').forEach(button => {
                button.addEventListener('click', function() {
                    const entryId = this.dataset.id;
                    const mapModal = document.getElementById('mapModal-' + entryId);
                    mapModal.style.display = 'none';
                });
            });

            $(document).on('click', '.likeBtn', function(e) {
                e.preventDefault();
                var seaviewId = $(this).data('id');
                $.ajax({
                    url: '/user/like/' + seaviewId,
                    type: 'GET',
                });
            });

            // Dislike button
            $(document).on('click', '.dislikeBtn', function(e) {
                e.preventDefault();
                var seaviewId = $(this).data('id');
                $.ajax({
                    url: '/user/dislike/' + seaviewId,
                    type: 'GET',
                });
            });
        </script>
    @endsection

</body>

</html>
