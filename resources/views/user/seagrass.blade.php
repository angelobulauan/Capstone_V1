<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sea Grasses</title>
    <style>
        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        }

        .card:hover {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 1rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
            padding: 0.5rem 1rem;
        }

        .btn-primary {
            background-color: #3490dc;
            border-color: #3490dc;
        }

        .custom-map-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
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
            <div class="row justify-content-center">
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
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . $d->photo) }}" alt="Seagrass Photo" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Seagrass</h5>
                                {{-- <p class="card-text">{{ $d->description }}</p> --}}
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm likeBtn"
                                            data-id="{{ $d->id }}">
                                            <i class="fas fa-heart"></i>
                                            <span
                                                id="like-count-{{ $d->id }}">{{ $interactions->firstWhere('seaviews_id', $d->id)->total_likes ?? 0 }}</span>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm dislikeBtn"
                                            data-id="{{ $d->id }}">
                                            <i class="fas fa-heart-broken"></i>
                                            <span
                                                id="dislike-count-{{ $d->id }}">{{ $interactions->firstWhere('seaviews_id', $d->id)->total_dislikes ?? 0 }}</span>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <a href="#viewModal-{{ $d->id }}" data-toggle="modal"
                                            class="btn btn-success btn-sm">
                                            View More
                                        </a>

                                        <div class="modal fade" id="viewModal-{{ $d->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="viewModalLabel-{{ $d->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel-{{ $d->id }}">
                                                            </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-justify">
                                                        <h6>Scientific Name 1: {{ $d->scientificname1 }}</h6>
                                                        <h6>Scientific Name 2: {{ $d->scientificname2 }}</h6>
                                                        <h6>Scientific Name 3: {{ $d->scientificname3 }}</h6>
                                                        <div class="text-center">
                                                            <img src="{{ asset('storage/' . $d->photo) }}"
                                                                alt="seagrass" class="img-fluid mx-auto d-block">
                                                        </div>
                                                        <h5>Description:</h5>
                                                        <p>{{ $d->description }}</p>

                                                        <h5>Location:</h5>
                                                        <p>{{ $d->location }}</p>

                                                        <h5>Latitude & Logitude:</h5>
                                                        <p>{{ $d->latitude }} : {{ $d->longtitude }}</p>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            // Open modal for viewing more details
                                            $(document).on('click', '.btn[data-toggle="modal"]', function(e) {
                                                e.preventDefault();
                                                var targetModal = $(this).attr('href');
                                                $(targetModal).modal('show');
                                            });

                                            // Close modal
                                            $(document).on('click', '.close, .btn-secondary[data-dismiss="modal"]', function() {
                                                $(this).closest('.modal').modal('hide');
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-sm viewMapBtn"
                                            data-id="{{ $d->id }}"
                                            data-latitude="{{ $d->latitude }}"
                                            data-longtitude="{{ $d->longtitude }}">
                                            View Location
                                        </a>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <p class="text-success">
                                            <span
                                                id="view-count-{{ $d->id }}">{{ $interactions->firstWhere('seaviews_id', $d->id)->total_views ?? 0 }}</span>
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Modal -->
                    <div id="mapModal-{{ $d->id }}" class="custom-map-modal">
                        <div class="modal-content">
                            <span class="close closeMapModalBtn" data-id="{{ $d->id }}">&times;</span>
                            <div id="map-{{ $d->id }}" style="height: 400px;"></div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $myEntry->links() }}
                </div>
            </div>
        @endif

        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
        <script>
            document.querySelectorAll('.viewMapBtn').forEach(button => {
    button.addEventListener('click', function() {
        const entryId = this.dataset.id;
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
                center: {
                    lat: parseFloat(button.dataset.latitude),
                    lng: parseFloat(button.dataset.longtitude)
                } // Center map on the specified coordinates
            });

            // Add marker to the map
            new google.maps.Marker({
                position: {
                    lat: parseFloat(button.dataset.latitude),
                    lng: parseFloat(button.dataset.longtitude)
                },
                map: map
            });

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
