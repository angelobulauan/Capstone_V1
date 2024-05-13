@extends('layouts.LOUser.app')
@section('content')
    <style>
        #dashboard {
            margin: 0;
            padding: 0;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            position: relative;
        }

        .back-video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .transparent-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            background-color: rgba(255, 255, 255, 0);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
            text-align: center; /* Center the content horizontally */
        }

        h3 {
            font-size: 30px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            color: #ffffff; /* Darker text color */
            margin-bottom: 20px; /* Spacing below the title */
        }

        .input-group {
            display: flex;
            flex-direction: row;
            justify-content: center; /* Center the input and button horizontally */
            margin-top: 20px; /* Spacing above the input group */
        }

        #search-input {
            flex: 1;
            padding: .5rem 1rem;
            font-size: 1rem;
            border: none;
            outline: none;
            background: #e0dfdf;
            border-radius: 2rem 0 0 2rem;
        }

        #search-button {
            background: #3caebd;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            outline: none;
            border-radius: 0 2rem 2rem 0;
            padding: .5rem 1.5rem;
        }

        #search-button:hover {
            background: #2b7d88; /* Darker hover color */
        }

        /* Adjustments for smaller screens */
        @media (max-width: 576px) {
            h3 {
                font-size: 24px;
            }
        }
    </style>

    <div class="" id="dashboard">
        <video autoplay loop muted playsinline src="{{ asset('img/seagrass.mp4') }}" class="back-video"
            type="video/mp4"></video>
        <div class="transparent-card">
            <div class="content">
                <h3>Sea Grasses</h3>
                <form action="{{ url('/search') }}" method="get" role="search">
                    @csrf
                    @method('GET')
                    <div class="input-group">
                        <input id="search-input" name="keyword" type="search" autocomplete="off"
                            placeholder="Search" aria-label="Search..." required />
                        <button id="search-button" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
