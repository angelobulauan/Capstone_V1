@extends('layouts.LOSuperAdmin.app')
@section('content')
    @php
        $uploader = DB::table('users')->where('involvement', 'uploader')->where('is_verified', 1)->count();
        $unverifieduploader = DB::table('users')->where('involvement', 'uploader')->where('is_verified', 0)->count();
    @endphp

    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4x">

                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-success text-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <i class="fas fa-user fa-4x text-black-300 wobble-on-hover"></i>
                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $uploader }}</h3>
                                <h6 class="text-uppercase mb-1">Verified Uploader</h6>
                            </div>
                        </div>
                    </div>

                </div>

                <style>
                    .card:hover {
                        transform: scale(1.1);
                    }
                </style>
            </div>

            <div class="col-xl-3 col-md-6 mb-4x">

                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-danger text-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <i class="fas fa-user fa-4x text-black-300 wobble-on-hover"></i>
                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $unverifieduploader }}</h3>
                                <h6 class="text-uppercase mb-1">Unverified Uploader</h6>
                            </div>
                        </div>
                    </div>

                </div>

                <style>
                    .card:hover {
                        transform: scale(1.1);
                    }
                </style>
            </div>
        </div>
    </div>
@endsection


