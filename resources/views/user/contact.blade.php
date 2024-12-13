<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-4iFRndTElwPARgF7xrjkoX7z7evOD/zrJdqV6zDnLpJwxCjZvVvxiK7rI5S3yRQ7Vv6RXGsTAFXdSdO6wDnLpJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{asset('favicon.png') }}">
    <style>
        .contact-heading {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contact-heading h1 {
            font-weight: bold;
            font-style: italic;
            margin-bottom: 20px;
            text-align: center
        }

        .contact-heading p {
            font-size: 1.2rem;
        }

    </style>
</head>

<body>
    @extends('layouts.LOUser.app')
    @section('content')
        <section class="contact" style="background-image: url('{{ asset('img/contact.png') }}');background-size: cover;">
            <div class="container">
                <div class="left">
                    <div class="form-wrapper">
                        <div class="contact-heading">
                            <div class="card text-white bg-transparent mb-3"
                                style="border-radius: 30px; box-shadow: 0 0 10px rgba(255,255,255,0.3); backdrop-filter: blur(5px); transition: all 0.5s ease-in-out; animation: breathing 3s ease-in-out infinite;"
                                onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                                <div class="card-header">
                                    <img src="{{ asset('img/bg1.png') }}" alt="logo" style="width: 100px; height: 100px; margin: 0 auto 20px auto; display: block;">
                                    <h1> <span id="typing-text">Let's work together!</span></h1>
                                </div>
                                <div class="card-body">
                                    <p class="text">Reach us via: <i class="fa fa-envelope" style="font-size:24px;color:white"></i> <strong><a
                                            href="https://mail.google.com/mail/?view=cm&fs=1&to=seagrass.nc2024@gmail.com"
                                            target="_blank" style="color: white; text-decoration: none; font-size: 1.5rem;"
                                            onmouseover="this.style.color='#00ff7f'" onmouseout="this.style.color='white'">
                                            Seagrass.nc2024@gmail.com </a></strong></p>
                                    <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
                                        <a href="https://www.facebook.com/p/DENR-CENRO-APARRI-CAGAYAN-100067828756511/" target="_blank" class="m-2" style="font-size: 36px; color: white; transition: all 0.3s ease-in-out;"
                                            onmouseover="this.style.color='#00ff7f'; this.style.fontSize='50px'" onmouseout="this.style.color='white'; this.style.fontSize='36px'">
                                            <i class="fab fa-facebook-square"></i>
                                        </a>
                                        <a href="https://twitter.com/Seagrass_" target="_blank" class="m-2" style="font-size: 36px; color: white; transition: all 0.3s ease-in-out;"
                                            onmouseover="this.style.color='#00ff7f'; this.style.fontSize='50px'" onmouseout="this.style.color='white'; this.style.fontSize='36px'">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://www.instagram.com/seagrass_/" target="_blank" class="m-2" style="font-size: 36px; color: white; transition: all 0.3s ease-in-out;"
                                            onmouseover="this.style.color='#00ff7f'; this.style.fontSize='50px'" onmouseout="this.style.color='white'; this.style.fontSize='36px'">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                @keyframes breathing {
                    0% {
                        transform: scale(1);
                    }
                    50% {
                        transform: scale(1.05);
                    }
                    100% {
                        transform: scale(1);
                    }
                }
            </style>
        </section>

    @endsection

</body>

</html>

