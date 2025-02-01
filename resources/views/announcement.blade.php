<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
    background-image: url('{{ asset('img/mapbg.jpg') }}');
    background-size: cover; /* Ensures the image covers the entire background */
    background-repeat: no-repeat; /* Prevents the image from repeating */
    background-position: center; /* Centers the image */
    color: #f4f4f4; /* Ensures text is readable over the background */
    font-family: Arial, sans-serif;
    position: relative; /* Required for pseudo-element positioning */
    z-index: 0;
}


        .navbar {
    position: fixed;
    top: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.2); /* Semi-transparent background */
    backdrop-filter: blur(10px); /* Blur effect */
    -webkit-backdrop-filter: blur(10px); /* Safari support */
    z-index: 3;
    display: flex;
    justify-content: center;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Shadow for depth */
    border-bottom: 1px solid rgba(255, 255, 255, 0.3); /* Optional: Border for emphasis */
}
    .navbar a {
        color: #fff;
        text-decoration: none;
        font-size: 1rem;
        padding: 10px 15px;
        transition: color 0.3s ease, background 0.3s ease;
    }

    .navbar a:hover {
        color: #000;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 5px;
    }
    .navbar i {
        margin-right: 8px;
    }
</style>
<body>

    <!-- Navbar -->
<div class="navbar d-flex justify-content-between align-items-center">
    <!-- Navbar Links inside Collapsible Container -->
    <div class="collapse navbar-collapse d-lg-flex justify-content-center flex-grow-1" id="navbarNav">
        <a href="/#home" class="nav-link">
            <i class="fas fa-home"></i> Home
        </a>
        <a href="{{ route('map-guest') }}" class="nav-link">
            <i class="fas fa-map"></i> Map
        </a>
        <a href="/#article" class="nav-link">
            <i class="fas fa-newspaper"></i> Article
        </a>
        <a href="/#contact" class="nav-link">
            <i class="fas fa-envelope"></i> Contact Us
        </a>
    </div>

    <!-- Hamburger Menu Button -->
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>
</div>
  <!--Announcement Section-->
  <div class="row">
    @foreach($announcements as $announcement)
        <div class="col-md-4">
            <div class="card announcement-card p-3 mb-3">
                <h5>{{ $announcement->activity_name }}</h5>
                <p><strong>Date:</strong> {{ date('F d, Y', strtotime($announcement->event_date)) }}</p>
                <!-- Edit and Delete buttons -->
                <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $announcement->id }}, '{{ $announcement->activity_name }}', '{{ $announcement->event_date }}')">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="openDeleteModal({{ $announcement->id }})">Delete</button>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
