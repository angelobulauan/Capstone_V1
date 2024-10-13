<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



    <style>
        body {
            background-image: url(img/seagrass_image1.jpeg);
            background-size: cover;
            min-height: 100vh;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

        }

        .img-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .img-container img {
            width: 100%;
            padding: 1rem;
            max-width: 300px;
            height: auto;
        }

        .auth-container {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

        }

        .auth-container form {
            flex: 1;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px #00000033;
            padding: 3rem 2rem;
            border-radius: .5rem;
            background: white;

        }

        .auth-container img {
            height: 80px;
            width: 50%;
            border-radius: 50%;
            margin: 0 auto 1.5rem auto;
        }

        .welcome {
            max-width: fit-content;
            margin-inline: auto;
            color: white;
            /* font-weight: 300; */
        }
        .auth-container h1{
            color: black;
          text-align: center;
          font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }

    </style>

{{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}

</head>

<body>

 <div class="container">
        <div class="d-block d-lg-flex w-100">
            <div class="img-container">
                <div class="logo mb-3">

                        <img src="{{ asset('img/logo.png') }}" alt="ASSET Logo" >
                    </a>
                </div>
                <div class="welcome d-none d-lg-block">
                    <div class="d-flex align-items-center font-weight-normal mb-1">
                        <i class="fa fa-at mr-2"></i>
                        <span>seagrasses@gmail.com</span>
                    </div>
                    <div class="d-flex align-items-center font-weight-normal mb-1">
                        <i class="fa fa-phone mr-2"></i>
                        <span>(078) 888-0786 / (078) 888-0562</span>
                    </div>
                    <div class="d-flex align-items-center font-weight-normal mb-1">
                        <i class="fa fa-map-marker mr-2"></i>
                        <span>Sta. Ana, Cagayan</span>
                    </div>
                </div>
            </div>
            <div class="auth-container">

                <form method="POST" action="{{ route('login') }}">
                    <img src="{{ asset('img/bg1.png') }}" alt="Default Icon" loading="lazy" width="100" height="100" />
                    <h1>LOGIN</h1>
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>

                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
                        <input id="password" type="password" placeholder="Password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="off">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-check mb-1" style="text-align:right;">
                    @if (Route::has('password.request'))

                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            <small>{{ __('Forgot Your Password?') }}</small>
                        </a>

                    @endif
                    </div>

                    <button type="submit" class="btn btn-info btn-block">
                        <i class="fa fa-sign-in-alt mr-1"></i>
                        {{ __('Login') }}
                    </button>

                    <div class="text-center mt-3">
                        <small>
                            Don't have an account yet?&nbsp;<a href="{{ route('register') }}"> Sign Up</a>
                        </small>
                    </div>
                </form>
            </div>

            <div class="welcome d-block d-lg-none my-5">
                <div class="d-flex align-items-center font-weight-normal mb-1">
                    <i class="fa fa-phone mr-2"></i>
                    <span>(078) 888-0786 / (078) 888-0562</span>
                </div>
                <div class="d-flex align-items-center font-weight-normal mb-1">
                    <i class="fa fa-map-marker mr-2"></i>
                    <span>Sta. Ana, Cagayan</span>
                </div>
            </div>
        </div>
</div>

    <footer class="text-sm-start fixed-bottom bg-white">
        <small class="text-center p-1 d-block">
            © 2024 Copyright.
            <a class="text-dark">All right reserved</a>
        </small>

    </footer>
</body>

</html>
