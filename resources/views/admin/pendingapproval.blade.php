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
    @endif
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}"></script>
    
@endsection
