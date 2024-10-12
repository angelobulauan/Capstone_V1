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
        top: 40%;
        /* Adjusted to move higher on the page */
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        background-color: rgba(255, 255, 255, 0);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 90%;
        text-align: center;
        /* Center the content horizontally */
    }

    h3 {
        font-size: 80px;
        /* Adjusted to a smaller size */
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        color: #ffffff;
        /* Text color */
        margin-bottom: 20px;
        /* Spacing below the title */
    }

    .input-group {
        display: flex;
        justify-content: center;
        /* Center the buttons horizontally */
        margin-top: 20px;
        /* Spacing above the input group */
        gap: 20px;
        /* Add space between the buttons */
    }

    .btn-link {
        display: inline-flex;
        align-items: center;
        /* Vertically center icon and text */
        background-color: green;
        /* Button background color */
        padding: 15px 35px;
        /* Padding inside the button */
        color: white;
        /* Text and icon color */
        font-weight: 500;
        text-decoration: none;
        /* Remove underline */
        border-radius: 20px;
        /* More pronounced rounded corners */
        transition: background-color 0.3s ease;
    }

    .btn-link i {
        margin-right: 8px;
        /* Space between the icon and text */
    }

    .btn-link:hover {
        background-color: #6A84A3;
        /* Slightly darker background on hover */
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
            <div class="input-group">
                <a href="{{ route('user.article') }}" class="btn-link">
                    <i class="fas fa-book-open" style="margin-right: 8px;"></i> <!-- Updated Font Awesome icon -->
                    {{ __('Read More') }}
                </a>

                <a href="{{ route('user.contact') }}" class="btn-link">
                    <i class="fas fa-phone" style="margin-right: 10px;"></i> <!-- Example using phone icon -->
                    {{ __('Contact Us') }}
                </a>

            </div>



            </form>
        </div>
    </div>
</div>
@endsection