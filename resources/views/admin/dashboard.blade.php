@extends('layouts.LOAdmin.app')
@section('content')

@php
    $seagrassCount = DB::table('seaviews')
    ->count();

    $totalLikes = DB::table('sea_grass_likes')->where('likes', 1)->count();
    $totaldisLikes = DB::table('sea_grass_likes')->where('dislikes', 1)->count();
    $totalViews = DB::table('sea_grass_likes')->sum('views');


    /* pre tuloy muntu lang diffre=nt tables

    tables ->likes, dislike, mostviewd, mostsearched,
    */
@endphp
    <div class="container mt-5">
        <div class="row ">
            <div class="col-xl-3 col-md-6 mb-4x">
                <div class="card text-center">
                    <div class="card-header bg-primary text-white">
                        <div class="row align-items-center">
                            <div class="col ">
                            <i class="fas fa-user fa-4x text-black-300"></i>
                            </div>
                            <div class="col-auto">
                                <h3 class="display-4">{{$totaluser}}</h3>
                                <h6 class="text-uppercase mb-1">Users</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-header bg-info text-white">
                        <div class="row align-items-center">
                            <div class="col">
                            <i class="fas fa-seedling fa-4x text-black-300"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{$seagrassCount}}</h3>
                                <h6 class="text-uppercase mb-1">Sea Grass</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-header bg-secondary text-white">
                        <div class="row align-items-center">
                            <div class="col">
                            <i class="fas fa-chart-line fa-4x text-black-300"></i> 

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{$seagrassCount}}</h3>
                                <h6> Most Visited</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-header bg-success text-white">
                        <div class="row align-items-center">
                            <div class="col">
                            <i class="fas fa fa-search fa-4x text-black-300"></i> 

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{$seagrassCount}}</h3>
                                <h6>Most Search</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center">
                    <div class="card-header bg-danger text-white">
                        <div class="row  align-items-center">
                            <div class="col">
                            <i class="fas fa fa-thumbs-up fa-4x text-black-300"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{$totalLikes}}</h3>
                                <h6 class="text-uppercase mb-1">likes</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-header bg-dark text-white">
                        <div class="row align-items-center">
                            <div class="col">
                            <i class="fas fa fa-thumbs-down  fa-4x text-black-300"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{$totaldisLikes}}</h3>
                                <h6 class="text-uppercase mb-1">Dislikes</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center">
                    <div class="card-header bg-warning text-white">
                        <div class="row  align-items-center">
                            <div class="col">
                            <i class="fas fa fa-eye fa-4x text-black-300"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{$totalViews}}</h3>
                                <h6 class="text-uppercase mb-1">Views</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center">
                    <div class="card-header bg-light text-black">
                        <div class="row  align-items-center">
                            <div class="col">
                            <i class="fas fa fa-envelope fa-4x text-black-300"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">0</h3>
                                <h6 class="text-uppercase mb-1">Mails</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
