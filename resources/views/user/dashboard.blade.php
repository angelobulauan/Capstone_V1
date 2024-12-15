<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="shortcut icon" href="{{ asset('storage/favicon.png') }}">
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        #dashboard {
            height: 100vh;
            width: 100vw;
            position: relative;
            overflow: hidden;
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
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }

        h1 {
            font-size: 80px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            color: #ffffff;
            margin-bottom: 20px;
        }

        .input-group {
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin-top: 20px;
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
            background: #2b7d88;
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 24px;
            }
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    @extends('layouts.LOUser.app')
    @section('content')
        <div id="dashboard">
            <video autoplay loop muted playsinline src="{{ asset('seagrass_v2.mp4') }}" class="back-video"
                type="video/mp4"></video>
            <div class="transparent-card">
                <img src="{{ asset('img/bg1.png') }}" alt="logo" class="logo">
                <div class="content">
                    <h1 class="typing" style="animation-delay: 2s; animation-duration: 2s;"></h1>
                    <script>
                        const h1Element = document.querySelector('h1');
                        const text = 'SEA GRASSES OF NORTHERN CAGAYAN';

                        function typeText() {
                            if (!h1Element.textContent) {
                                h1Element.textContent = '';
                            }

                            if (h1Element.textContent.length < text.length) {
                                h1Element.textContent += text.charAt(h1Element.textContent.length);
                                setTimeout(typeText, 100); // Typing speed
                            } else {
                                setTimeout(removeText, 5000); // Wait 5 seconds before removing and typing again
                            }
                        }

                        typeText(); // Start the typing animation
                    </script>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('user.article') }}" style="text-decoration: none;"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                            Read More
                        </a>
                        <a href="{{ route('user.contact') }}" style="text-decoration: none;"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                            Contact Us
                        </a>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    <footer class="text-sm-start fixed-bottom bg-transparent">

        <small class="text-center p-1 d-block text-white">
            &copy; 2024 Copyright.
            All right reserved
            &nbsp;
            <a class="text-white" href="/devs">Meet the Devs</a>
        </small>

    </footer>
</body>

</html>


