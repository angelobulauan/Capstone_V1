<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEA GRASS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <style>
    *{
        margin: 0; 
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    }
    .home{
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background: whitesmoke;
    }
    .home:before{
        z-index: 777;
        content: '';
        position: absolute;
        background: rgba(3, 56, 56, 0.3);
        width: 100%;
        height: 100%;
        top: 0 ;
        left: 0;
    }
    .home .content{
        z-index: 888;
        color: white;
        width: 70%;
        margin-top: 50px;
        
    }
    .home .content h1{
        font-size: 100px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 5px;
        line-height: 80px;
        padding-left: 30px;
        font-family:Arial, Helvetica, sans-serif;
        color: #DC8516;
        
        
    }
    .home .content h2{
        font-size: 3em;
        /* margin-bottom: 30px; */
        padding-left: 80px;
        letter-spacing: 5px;
        font-weight: 900;
    }
    .home .content h1 span{
        font-size: 1.2em;
        font-weight: 600;
        padding-left: 50px;
    }
    .home .content p{
        margin-bottom: 55px;
        padding-left: 30px;
        font-size: 25px;
        font-weight: 500;
        font-family: 'Times New Roman', Times, serif;
    }
    .home .content a{
        background: #7D96BD;
        padding: 15px 35px;
        color: white;
        font-weight: 500;
        text-decoration: none;
        border-radius: 20px;
        margin-left: 80px;
    }
    .home .content a:hover{
        background-color: blue;
    }
    .home .media-icons{
        z-index: 888;
        position: absolute;
        right: 30px;
        display: flex;
        flex-direction: column;
        transition: 0.5s ease;
    }
    .home .media-icons a{
        color: white;
        font-size: 1.6em;
        transition: 0.3s ease;
    }
    .home .media-icons a:not(:last-child){
        margin-bottom: 20px;
    }
    .home .media-icons a:hover{
        transform: scale(1.3);
    }
    .home video{
        z-index: 000;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        
    }
    .slider-navigation{
        z-index: 888;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        transform: translate(80px);
        margin-bottom: 12px;
    }
    .slider-navigation .nav-btn{
        width: 12px;
        height: 12px;
        background: #fff;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 0 2px rgba(255, 255, 255, 0.5);
        transition: 0.3s ease;
    }
    .slider-navigation .nav-btn.active{
        background: blue;
    }
    .slider-navigation .nav-btn:not(:last-child){
        margin-right: 20px;
    }
    .slider-navigation .nav-btn:hover{
        transform: scale(1.4);
    }
    .video-slide{
        position: absolute;
        width: 100%;
        clip-path: circle(0.3% at 0 50%);
    }
    .video-slide.active{
        clip-path: circle(150% at 0 50%);
        transition: 2s ease;
        transition-property:clip-path;
    }
  </style>
 <body>
    <div class="container-fluid">
<section class="home">
    <video  class="video-slide" src="{{asset('img/wl/vb1.mp4')}}" autoplay muted loop></video>
    <video  class="video-slide" src="{{asset('img/wl/vb2.mp4')}}" autoplay muted loop></video>
    <video  class="video-slide" src="{{asset('img/wl/vb3.mp4')}}" autoplay muted loop></video>
    <video  class="video-slide" src="{{asset('img/wl/vb4.mp4')}}" autoplay muted loop></video>
    <video  class="video-slide" src="{{asset('img/wl/vb5.mp4')}}" autoplay muted loop></video>
    <div class="content">
        <h1>Sea Grasses </h1>
        <h2> of Sta.Ana, Cagayan <span></span></h2>
        <p>Welcome!  Seagrasses play very important roles in marine ecosystem and we need to conserve and take care for these magestic species.</p>
             <a href="{{ route('login') }}">{{ __('Get Started') }}</a>
             
    </div>
    <div class="media-icons">
        <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
    </div>
    <div class="slider-navigation">
        <div class="nav-btn active"></div>
        <div class="nav-btn"></div>
        <div class="nav-btn"></div>
        <div class="nav-btn"></div>
        <div class="nav-btn"></div>
    </div>
</section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script>
const btns = document.querySelectorAll(".nav-btn");
const slides = document.querySelectorAll(".video-slide");
var sliderNav = function(manual){
    btns.forEach((btn) => {
        btn.classList.remove("active");
    });

    slides.forEach((slide) => {
        slide.classList.remove("active");
    });
    btns[manual].classList.add("active");
    slides[manual].classList.add("active");
}

 btns.forEach((btn, i) =>{
    btn.addEventListener("click", () => {
sliderNav(i);
    });
 });
</script>
  </body>
</html>