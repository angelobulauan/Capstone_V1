<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEA GRASS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        body {
            overflow-x: hidden;
        }

        .home {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
            background: whitesmoke;
        }

        .slideshow {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        .home .content {
            z-index: 2;
            color: white;
            width: 70%;
            margin-top: 50px;
            position: relative;
        }

        .home .content h1 {
            font-size: 100px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 5px;
            line-height: 80px;
            padding-left: 30px;
            font-family: Arial, Helvetica, sans-serif;
            color: #DC8516;
            text-shadow:
                -1px -1px 0 #fff,
                1px -1px 0 #fff,
                -1px 1px 0 #fff,
                1px 1px 0 #fff;
        }

        .home .content h2 {
            font-size: 3em;
            padding-left: 80px;
            letter-spacing: 5px;
            font-weight: 900;
        }

        .home .content p {
            margin-bottom: 55px;
            padding-left: 30px;
            font-size: 20px;
            font-weight: 400;
            font-family: 'Times New Roman', Times, serif;
        }

        .home .content a {
            background: green;
            padding: 15px 35px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            border-radius: 20px;
            margin-left: 80px;
        }

        .home .content a:hover {
            background-color: limegreen;
        }

        .home .media-icons {
            z-index: 2;
            position: absolute;
            right: 50px;
            display: flex;
            flex-direction: column;
        }

        .home .media-icons a {
            color: white;
            font-size: 1.6em;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <section class="home">
        <div class="slideshow">
            <div class="slide active" style="background-image: url('{{ asset('img/wl/welcome.jpg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('img/seagrass_image1.jpeg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('img/seagrass_image2.jpeg') }}');"></div>
            <div class="slide" style="background-image: url('{{ asset('img/seagrass_image3.jpeg') }}');"></div>
        </div>
        <div class="content">
            <h1 class="typing" style="animation-delay: 2s; animation-duration: 5s;"></h2>
                <br>
            <p style="font-size: 1.2em;">Welcome! Seagrasses play very important roles in marine ecosystems, and we need to conserve and take care
                of these majestic species. Explore our website to learn more and discover how you can help protect these
                amazing plants.</p>
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> {{ __('Get Started') }}
            </a>
        <script>
            const typingElement = document.querySelector('.typing');
            const text = 'Sea Grasses of Northern Cagayan';
            let index = 0;
            const type = () => {
                if (index < text.length) {
                    typingElement.textContent += text[index];
                    index++;
                    setTimeout(type, 100);
                }
            };
            type();
        </script>

        </div>
        <div class="media-icons">
            <a href="#"><i class="fa fa-facebook-square" aria-hidden="true" style="transition: all 0.3s ease-in-out;"
                    onmouseover="this.style.fontSize='2em';"
                    onmouseout="this.style.fontSize='1.6em';"></i></a>
            <a href="#"><i class="fa fa-twitter-square" aria-hidden="true" style="transition: all 0.3s ease-in-out;"
                    onmouseover="this.style.fontSize='2em';"
                    onmouseout="this.style.fontSize='1.6em';"></i></a>
            <a href="#"><i class="fa fa-instagram" aria-hidden="true" style="transition: all 0.3s ease-in-out;"
                    onmouseover="this.style.fontSize='2em';"
                    onmouseout="this.style.fontSize='1.6em';"></i></a>
        </div>
    </section>

    <script>
        // JavaScript for the slideshow
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        setInterval(nextSlide, 3000); // Change slide every 3 seconds
    </script>
</body>

</html>
