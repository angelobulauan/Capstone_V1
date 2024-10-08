@extends('layouts.LOUser.app')

@section('content')
    @php
        $myEntry = DB::table('seaviews')
            ->orderBy('created_at', 'desc')
            ->get();
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
                                <div class="col-sm-6 p-1">Name: {{ $d->name }}</div>
                                <div class="col-sm-6 p-1">Scientific Name: {{ $d->scientificname }}</div>
                                <div class="col-sm-6 p-1">
                                    <i class="fa fa-info-circle mr-2 text-primary"></i>Description: {{ $d->description }}
                                </div>
                                <div class="col-sm-6 p-1">
                                    <i class="fa fa-map-marker mr-2 text-warning"></i>Location: {{ $d->location }}
                                </div>
                                <div class="col-sm-6 p-1">
                                    <i class="fa fa-map-pin mr-2"></i>Abundance: {{ $d->abundance }}
                                </div>

                                <div class="row mt-0">
                                    <div class="col-sm-3 d-flex justify-content-start align-items-center">
                                        <button type="button" class="btn btn-primary viewMapBtn"
                                            data-id="{{ $d->id }}">
                                            View Location
                                        </button>
                                    </div>
                                    <div class="col-sm-9 d-flex justify-content-end align-items-center">
                                        <a href="javascript:void(0);" class="p-4 likeBtn" data-id="{{ $d->id }}">
                                            <i class="fas fa fa-thumbs-up fa-2x text-black-300"></i>
                                            <span
                                                id="like-count-{{ $d->id }}">{{ $interaction->total_likes ?? 0 }}</span>
                                        </a>
                                        <a href="javascript:void(0);" class="dislikeBtn" data-id="{{ $d->id }}">
                                            <i class="fas fa fa-thumbs-down fa-2x text-red-300"></i>
                                            <span
                                                id="dislike-count-{{ $d->id }}">{{ $interaction->total_dislikes ?? 0 }}</span>
                                        </a>
                                        <p class="text-danger pl-4 mt-4">
                                            <span
                                                id="view-count-{{ $d->id }}">{{ $interaction->total_views ?? 0 }}</span>
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

        <div class="modal mapCont" id="mapModal-{{ $d->id }}" tabindex="-1" role="dialog" style="display:none;">
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
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.viewMapBtn', function() {
                var seaviewId = $(this).data('id');

                $.ajax({
                    url: '/user/updateView/' +
                    seaviewId,
                    type: 'GET',
                    success: function(response) {
                        console.log('Response received:', response);

                        if (response && response.views !== undefined) {
                            $('#view-count-' + seaviewId).text(response.views);
                            console.log('View count updated. Total views: ' + response.views);
                        } else {
                            console.log('Unexpected response format:', response);
                        }
                    },
                    error: function(xhr) {
                        console.log('AJAX error:', xhr.responseText);
                    }
                });

                $("#mapModal-" + seaviewId).fadeIn();
                initializeMap(seaviewId);
            });

            $(document).on('click', '.closeMapModalBtn', function() {
                var id = $(this).data('id');
                $("#mapModal-" + id).fadeOut();
            });

            function initializeMap(id) {
                var map = new google.maps.Map(document.getElementById('map-' + id), {
                    center: {
                        lat: 0,
                        lng: 0
                    },
                    zoom: 2
                });

                @foreach ($myEntry as $d)
                    if ({{ $d->id }} == id) {
                        var marker = new google.maps.Marker({
                            position: {
                                lat: {{ $d->lati }},
                                lng: {{ $d->longti }}
                            },
                            map: map,
                            title: "{{ $d->name }}"
                        });

                        map.setCenter({
                            lat: {{ $d->lati }},
                            lng: {{ $d->longti }}
                        });
                        map.setZoom(13);
                    }
                @endforeach
            }

            $(document).on('click', '.likeBtn', function(e) {
                e.preventDefault();
                var seaviewId = $(this).data('id');

                $.ajax({
                    url: '/user/like/' + seaviewId,
                    type: 'GET',
                    success: function(response) {
                        $('#like-count-' + seaviewId).text(response.likes);
                        $('#dislike-count-' + seaviewId).text(
                            0);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    },
                    error: function(xhr) {
                        console.log('Like AJAX error:', xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.dislikeBtn', function(e) {
                e.preventDefault();
                var seaviewId = $(this).data('id');

                $.ajax({
                    url: '/user/dislike/' + seaviewId,
                    type: 'GET',
                    success: function(response) {
                        $('#dislike-count-' + seaviewId).text(response.dislikes);
                        $('#like-count-' + seaviewId).text(
                            0);
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        });
                    },
                    error: function(xhr) {
                        console.log('Dislike AJAX error:', xhr.responseText);
                    }
                });
            });

        });
    </script>
@endsection
