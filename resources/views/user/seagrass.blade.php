@extends('layouts.LOUser.app')
@section('content')
    @php
        $myEntry = DB::table('seaviews')
            ->orderBy('created_at', 'desc') // Order by the 'created_at' column in descending order
            ->get();
    @endphp

    @foreach ($myEntry as $d)
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <img src="{{ asset('storage/' . $d->photo) }}" alt="First Photo" class="img-fluid"
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
                                <div class="col-sm-6 p-1">Created At: {{ $d->created_at }}</div>
                                <div class="row mt-0">
                                    <!-- <div class="text-center"> -->
                                    <div class="col-sm-12 d-flex justify-content-end align-items-center">
                                        <a href="" class="p-4">
                                            <i class="fas fa fa-thumbs-up fa-2x text-black-300"></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa fa-thumbs-down fa-2x text-red-300"></i>
                                        </a>
                                        <p class="text-danger pl-4 mt-4"><span>500</span>  Views</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    @endforeach
@endsection
