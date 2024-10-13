@extends('layouts.LOAdmin.app')
@section('content')
    @php
        $seagrassCount = DB::table('seaviews')->count();

        $totalLikes = DB::table('sea_grass_likes')->where('likes', 1)->count();
        $totaldisLikes = DB::table('sea_grass_likes')->where('dislikes', 1)->count();
        $totalViews = DB::table('sea_grass_likes')->sum('views');
        $pendingApproval = DB::table('seaviews')->where('status', 'pending')->count();

        /* pre tuloy muntu lang diffre=nt tables

    tables ->likes, dislike, mostviewd, mostsearched,
    */

    @endphp
    <div class="container mt-5">
        <div class="row ">


            <div class="col-xl-3 col-md-6 mb-4x">

                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <a href="{{ route('admin.view') }}" style="text-decoration: none;">
                        <div class="card-header bg-secondary text-white">
                            <div class="row align-items-center">
                                <div class="col ">
                                    <i class="fas fa-user fa-4x text-black-300 wobble-on-hover"></i>
                                </div>
                                <div class="col-auto">
                                    <h3 class="display-4">{{ $totaluser }}</h3>

                                    <h6 class="text-uppercase mb-1" style="color: white;">Users</h6>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <style>
                    .card:hover {
                        transform: scale(1.1);
                    }
                </style>

            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <a href="{{ route('admin.myEntries') }}" style="text-decoration: none;">
                        <div class="card-header bg-success text-white">
                            <div class="row align-items-center">
                                <div class="col">
                                    <i class="fas fa-seedling fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                                </div>
                                <div class="col">
                                    <h3 class="display-4">{{ $seagrassCount }}</h3>

                                    <h6 class="text-uppercase mb-1">Sea Grass</h6>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <style>
                    .card:hover {
                        transform: scale(1.1);
                    }
                </style>

            </div>

            <style>
                .wobble-on-hover:hover {
                    animation: wobble 0.5s ease-in-out;
                }

                @keyframes wobble {
                    0% {
                        transform: rotate(0deg);
                    }

                    25% {
                        transform: rotate(-5deg);
                    }

                    50% {
                        transform: rotate(0deg);
                    }

                    75% {
                        transform: rotate(5deg);
                    }

                    100% {
                        transform: rotate(0deg);
                    }
                }
            </style>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <a href="{{ route('admin.admin.pendingapproval') }}" style="text-decoration: none;">
                        <div class="card-header bg-info text-white">
                            <div class="row  align-items-center">
                                <div class="col">
                                    <i class="fas fa-hourglass-half fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                                </div>
                                <div class="col">
                                    <h3 class="display-4">{{ $pendingApproval }}</h3>

                                    <h6 class="text-uppercase mb-1">Pending</h6>

                                </div>

                            </div>
                        </div>
                    </a>
                </div>

                <style>
                    .card:hover {
                        transform: scale(1.1);
                    }
                </style>

            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-primary text-white">
                        <div class="row  align-items-center">
                            <div class="col">
                                <i class="fas fa fa-thumbs-up fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $totalLikes }}</h3>
                                <h6 class="text-uppercase mb-1">likes</h6>
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

            <div class="col-md-3">
                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-danger text-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <i class="fas fa fa-thumbs-down  fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $totaldisLikes }}</h3>
                                <h6 class="text-uppercase mb-1">Dislikes</h6>
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

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-warning text-white">
                        <div class="row  align-items-center">
                            <div class="col">
                                <i class="fas fa fa-eye fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $totalViews }}</h3>
                                <h6 class="text-uppercase mb-1">Views</h6>
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

