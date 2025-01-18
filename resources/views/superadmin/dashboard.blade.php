@extends('layouts.LOSuperadmin.app')
@section('content')
<link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">

    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4x">

                <div class="card text-center" style="transition: all 0.3s ease-in-out;">
                    <div class="card-header bg-success text-white">
                        <div class="row align-items-center">
                            <div class="col">
                                <i class="fas fa-user fa-4x text-black-300 wobble-on-hover"></i>
                            </div>
                            {{--  --}}
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


