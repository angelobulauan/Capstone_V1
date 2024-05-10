@extends('layouts.LOUser.app')
@section('content')



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


        {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}} 
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>

        h3{
            font-size: 100px;
            font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            padding-top: 80px;
            margin-top: 40px;
            color: white;
        }
        form {
            margin: 0 auto 20% auto;
            width: 100% !important;
            max-width: 500px;
            
          
        }

        .input-group {
            width: 100%;
            display: flex;
            flex-direction: row;
            padding-top: 60px;
         
            
        }

        #search-input {
            flex: 1;
            display: block;
            padding: .5rem 1rem;
            font-size: 1rem;
            border: none;
            outline: none;
            background: #e0dfdf;
            border-radius: 2rem 0 0 2rem;
            line-height: 1rem !important;
            
        }

        #search-button {
            display: block;
            flex: 0;
            background:#3caebd;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            border: none;
            outline: none;
            border-radius: 0 2rem 2rem 0;
            padding: .5rem 1.5rem;
        }

        #search-input,
        #search-button {
            text-align: left;
            margin: 0;
        }

        .search-button:hover {
            background: #ccc;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        nav #search-button {
            background: #2b7d88 !important;
            border: #2b7d88 !important;
        }

        nav #search-button:hover {
            background: #3caebd !important;
            border: #3caebd !important;
        }

        nav #search-input {
            border-color: #2b7d88 !important;
            outline: none !important;

        }

        nav #search-input:focus {
            border-color: #3caebd !important;
            outline: none !important;
            box-shadow: none !important;
        }
    .back-video{
        position: fixed;
    }
    </style>
    
</head>

<body class="antialiased ">

  
  

    <video autoplay loop muted plays-inline class="back-video">
      <source src="img/seagrass.mp4" type="video/mp4">
      </video>
    <main class="container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8 form-container">
                 
                    <div class="text-center">
                    <h3>Sea Grasses</h3>
                    </div>
    <form action=" {{ url('/search') }}" method="get" role="search">
                        @csrf
                        @method('GET')
                        <div class="input-group">
                            <input id="search-input" name="keyword" type="search"  autocomplete="off" placeholder="Search"
                                aria-label="Search..." required />
                            <button id="search-button" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
       
    </main>
    

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
</body>

</html>

@endsection