<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
</head>

<body>
@extends('layouts.LOAdmin.app')
@section('content')
    @php
        $seagrassCount = DB::table('seaviews')->count();
        $totalLikes = DB::table('sea_grass_likes')->where('likes', 1)->count();
        $totalDislikes = DB::table('sea_grass_likes')->where('dislikes', 1)->count();
        $totalViews = DB::table('sea_grass_likes')->sum('views');
        $pendingApproval = DB::table('seaviews')->where('status', 'pending')->count();
        $uploader = DB::table('users')->where('involvement', 'uploader')->where('is_verified', 1)->count();
        $unverifieduploader = DB::table('users')->where('involvement', 'uploader')->where('is_verified', 0)->count();

        $userActivity = DB::table('users')
            ->selectRaw("DATE_FORMAT(created_at, '%M') as label, COUNT(*) as y")
            ->groupByRaw("DATE_FORMAT(created_at, '%Y-%m'), DATE_FORMAT(created_at, '%M')")
            ->orderByRaw('MIN(created_at)')
            ->get()
            ->toArray();
    @endphp

    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4x">

                <div class="card text-center" style="transition: all 0.3s ease-in-out;">

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
                                    <i class="fas fa-hourglass-half fa-4x text-black-300 wobble-on-hover"></i>
                                    <!-- Grass icon -->

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
                                <i class="fas fa fa-thumbs-down  fa-4x text-black-300 wobble-on-hover"></i>
                                <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $totalDislikes }}</h3>
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

            <div class="col-xl-3 col-md-6 mb-4 ">
                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-primary text-white">
                        <div class="row  align-items-center">
                            <div class="col">
                                <i class="fas fa fa-user fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $uploader }}</h3>
                                <h6 class="text-uppercase mb-1">Verified</h6>
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
                    <div class="card-header bg-danger text-white">
                        <div class="row  align-items-center">
                            <div class="col">
                                <i class="fas fa fa-user fa-4x text-black-300 wobble-on-hover"></i> <!-- Grass icon -->

                            </div>
                            <div class="col">
                                <h3 class="display-4">{{ $unverifieduploader }}</h3>
                                <h6 class="text-uppercase mb-1">Unverified</h6>
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

        <!-- Chart section -->
        <div class="row">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Likes vs Dislikes
                    </div>
                    <div class="card-body">
                        <div id="likesDislikesChart" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header bg-secondary text-white">
                        User Activity
                    </div>
                    <div class="card-body">
                        <div id="userActivityChart" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        Verified vs Unverified Uploader
                    </div>
                    <div class="card-body">
                        <div id="uploaderChart" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.onload = function() {
            // Likes vs Dislikes Pie Chart
            var likesDislikesChart = new CanvasJS.Chart("likesDislikesChart", {
                animationEnabled: true,
                theme: "light",
                title: {
                    text: "Likes and Dislikes Distribution"
                },
                data: [{
                    type: "doughnut",
                    indexLabel: "{label}: {y}",
                    yValueFormatString: "#,##0",
                    dataPoints: [{
                            label: "Likes",
                            y: {{ $totalLikes }},
                            color: "blue"
                        },
                        {
                            label: "Dislikes",
                            y: {{ $totalDislikes }},
                            color: "red"
                        }
                    ]
                }]
            });
            likesDislikesChart.render();

            // User Activity Line Graph
            var userActivityChart = new CanvasJS.Chart("userActivityChart", {
                animationEnabled: true,
                theme: "light2",
                title: {
                    text: "User Activity Over Time"
                },
                axisY: {
                    title: "Number of Users"
                },
                data: [{
                    type: "line",
                    indexLabelFontSize: 16,
                    dataPoints: @json($userActivity)
                }]
            });
            userActivityChart.render();
        }


        // Verified vs Unverified Uploader Column Chart
        var uploaderChart = new CanvasJS.Chart("uploaderChart", {
            animationEnabled: true,
            theme: "light",
            title: {
                text: "Verified and Unverified Uploader"
            },
            axisY: {
                title: "Number of Users"
            },
            data: [{
                type: "column",
                indexLabelFontSize: 16,
                dataPoints: [{
                        label: "Verified Uploader",
                        y: {{ $uploader }}
                    },
                    {
                        label: "Unverified Uploader",
                        y: {{ $unverifieduploader }}
                    }
                ]
            }]
        });
        uploaderChart.render();
    </script>
@endsection
