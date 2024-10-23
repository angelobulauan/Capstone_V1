<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pending Approval</title>
</head>

<body>
@extends('layouts.LOadmin.app')

@section('content')
    @php
        $myEntry = DB::table('seaviews')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
    @endphp

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

@if($myEntry->isEmpty())
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row justify-content-center">
            <div class="col-sm-12 text-center">
                <h2>No Pending Approval to be approved</h2>
            </div>
        </div>
    </div>
@else
    @foreach ($myEntry as $d)
        @php
            $interaction = $interactions->firstWhere('seaviews_id', $d->id);
        @endphp
        <div class="container">
            <div class="row mt-3">
                <div class="col-sm-3">
                    <img src="{{ asset('storage/' . $d->photo) }}" alt="First Photo" class="img"
                        id="imageToSelect-{{ $d->id }}">
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 p-1"> <i class="fa fa-leaf mr-1 text-success"></i>Name: {{ $d->name }}</div>
                                <div class="col-sm-6 p-1">  <i class="fa fa-microscope  text-secondary"></i> Scientific Name: {{ $d->scientificname }}</div>
                                <div class="col-sm-6 p-1">
                                    <i class="fa fa-info-circle mr-1 text-primary"></i>Description: {{ $d->description }}
                                </div>
                                <div class="col-sm-6 p-1">
                                    <i class="fa fa-map-marker-alt mr-1 text-warning"></i>Location: {{ $d->location }}
                                </div>
                                <div class="col-sm-6 p-1">
                                    <i class="fa fa-map-pin mr-2"></i>Abundance: {{ $d->abundance }}
                                </div>

                                <div class="row mt-0">
                                    <div class="col-sm-3 d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn btn-primary viewMapBtn"
                                                    data-id="{{ $d->id }}"
                                                    data-coordinates="{{ $d->polygon_coordinates }}">
                                                    View Location
                                                </button>
                                    </div>
                                    <div class="col-sm-9 d-flex justify-content-end align-items-center">
    <form action="{{ route('admin.admin.approve', $d->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="action" value="approve">
        <button type="submit" class="btn btn-primary">
    <i class="fas fa-check"></i> Approve
</button>

    </form>
    <form action="{{ route('admin.admin.reject', $d->id) }}" method="post" class="ms-2">
        @csrf
        @method('PUT')
        <input type="hidden" name="action" value="reject">
        <button type="submit" class="btn btn-danger">
    <i class="fas fa-times"></i> Reject
</button>

    </form>
</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

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
