<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">



    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
           background-image: url('img/bg2.jpg');
           background-size: cover;
            min-height: 100vh;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container > div {
            flex-direction: row-reverse;
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
            padding: 2rem 0;
            max-width: 300px;
            height: auto;
        }

        .auth-container {
            flex: 1;
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-inline: auto;

        }

        .auth-container form {
            flex: 1;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px #00000033;
            padding: 1em 2rem;
            border-radius: .5rem;
            background: white;

        }


        .auth-container img {
            height: 150px;
            width: 60%;
            border-radius: 50%;
            margin: 0 auto 1.5rem auto;

        }

        .welcome {
            width: 100%;
            max-width: 400px;
            margin-inline: auto;
            padding: 0 .5rem 3rem .5rem;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: white;
            font-size: 25px;
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
    <div class="container pb-3">
        <div class="d-block d-lg-flex w-100">
            <div class="img-container">
                <div class="logo mb-1">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('img/lg.png') }}" alt="ASSET Logo" >
                    </a>
                </div>
                <div class="welcome text-center">
              "Learn to preserve the beauty and abudance of sea grasses in our town"
                </div>
            </div>
            <div class="auth-container">

                <form method="POST" action="{{ route('register') }}">
                    <img src="{{ asset('img/bg.png') }}" alt="Default Icon" loading="lazy" />
                    <h1>Register</h1>
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user-alt"></i>
                            </span>
                        </div>
                        <input id="name" type="name" placeholder="Full Name"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="off" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
                        <input id="email" type="email" placeholder="Email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="off" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
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

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user-lock"></i>
                            </span>
                        </div>
                        <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control"
                            name="password_confirmation" required autocomplete="off">
                        @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user-lock"></i>
                            </span>
                        </div>
                        <select id="involvement" class="form-control @error('involvement') is-invalid @enderror" name="involvement">
                            <option value="viewer">Viewer</option>
                            <option value="uploader">Contributor</option>
                        </select>
                        @error('involvement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-info btn-block">
                        <i class="fa fa-sign-in-alt mr-1"></i>
                        {{ __('Register') }}
                    </button>

                    <div class="text-center mt-3">
                        <small>
                            Already have an account?&nbsp;<a href="{{ route('login') }}"> Log In</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <footer class="text-sm-start fixed-bottom bg-white">
        <small class="text-center p-1 d-block">
            2024 Copyright.
            <a class="text-dark">All right reserved</a>
        </small>
    </footer> -->
</body>

</html>
