<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SEA GRASS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Global Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        }

        body {
            overflow-x: hidden;
            margin: 0;
            background-color: #f4f4f9;
        }

        /* Home Section */
        .home {
            position: relative;
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: whitesmoke;
            overflow: hidden;
        }

        /* Slideshow */
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

        /* Content */
        .home .content {
            z-index: 2;
            color: white;
            width: 70%;
            position: relative;
            text-align: center;
        }

        .home .content h1 {
            font-size: 70px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 5px;
            line-height: 80px;
            margin-bottom: 20px;
            color: #DC8516;
            text-shadow: -1px -1px 0 #fff, 1px -1px 0 #fff, -1px 1px 0 #fff, 1px 1px 0 #fff;
        }

        .home .content p {
            font-size: 18px;
            margin-bottom: 30px;
            line-height: 1.6;
            font-family: 'Times New Roman', Times, serif;
            color: #ffffff;
        }

        .home .content a {
            background: green;
            padding: 15px 35px;
            color: white;
            font-weight: 500;
            text-decoration: none;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        .home .content a:hover {
            background-color: limegreen;
        }

        /* Media Icons */
        .home .media-icons {
            z-index: 2;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
        }

        .home .media-icons a {
            color: white;
            font-size: 1.6em;
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }

        .home .media-icons a:hover {
            font-size: 2em;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .home .content h1 {
                font-size: 40px;
                line-height: 50px;
            }

            .home .content p {
                font-size: 16px;
            }

            .home .content a {
                padding: 10px 20px;
            }

            .home .media-icons {
                right: 10px;
            }
        }

        @media (max-width: 480px) {
            .home .content h1 {
                font-size: 30px;
                line-height: 40px;
            }

            .home .content p {
                font-size: 14px;
            }

            .home .content a {
                padding: 8px 15px;
                font-size: 14px;
            }

            .home .media-icons a {
                font-size: 1.4em;
            }
        }

        /* Navigation Bar */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #333;
            z-index: 3;
            display: flex;
            justify-content: center;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .section {
            padding-top: 80px;
            padding-bottom: 40px;
        }

        .section h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
        }

        .section p {
            font-size: 1.2em;
            line-height: 1.6;
            color: #666;
        }

        .section .content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

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
            text-align: center;
        }

        .contact-heading p {
            font-size: 1.2rem;
        }

        .card {
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: all 0.5s ease-in-out;
            animation: breathing 3s ease-in-out infinite;
        }

        .card:hover {
            transform: scale(1.1);
        }

        .card-header img {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px auto;
            display: block;
        }

        .card-body a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .card-body a:hover {
            color: #00ff7f;
        }

        .card-body .social-icons a {
            font-size: 36px;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        .card-body .social-icons a:hover {
            color: #00ff7f;
            font-size: 50px;
        }

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

        h1 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            font-weight: 800;
            font-size: 50px;
        }

        /* Mission Section */
        #mission {
            margin: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .mission__container {
            padding-bottom: 20px;
            padding-left: 20px;
            padding-right: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            /* Adjusted min-width to 400px */
            gap: 2rem;
            /* Increased gap for better spacing */
        }

        .mission-vision {
            background-color: rgba(19, 125, 177, 255);
            text-align: center;
            border: 1px solid transparent;
            border-radius: 20px;
            width: 100%;
        }

        .info {
            padding: 3rem 5rem;
            /* Increased padding for a more spacious look */
        }

        .info h1 {
            font-weight: normal;
            color: white;
            font-size: 40px;
        }

        .info p {
            margin: 1.2rem 0 2rem;
            font-size: 1.2rem;
            color: #fff;
            font-weight: 500;
            text-align: justify;
        }

        .moreText {
            display: none;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="#home">Home</a>
        <a href="{{ route('map-guest') }}">Map</a>
        <a href="#article">Article</a>
        <a href="#contact">Contact Us</a>
    </div>
    <section id="home" class="home section">
        <div class="slideshow">
            <div class="slide active" style="background-image: url('{{ asset('img/wl/welcome.jpg') }}');"></div>
        </div>
        <div class="content">
            <h1 class="typing"></h1>
            <p>Welcome! Seagrasses play very important roles in marine ecosystems, and we need to conserve and take care
                of these majestic species. Explore our website to learn more and discover how you can help protect these
                amazing plants.</p>
            <a href="{{ route('login') }}">
                <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> {{ __('Get Started') }}
            </a>
        </div>
        <div class="media-icons">
            <a href="https://www.facebook.com/p/DENR-CENRO-APARRI-CAGAYAN-100067828756511/"><i
                    class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </section>
    <section id="article" class="section">
        <div class="content">
            <div class="container">
                <h1 class="Title text-center py-4">ARTICLE</h1>
                <section class="mission">
                    <div class="mission__container">
                        <article class="mission-vision">
                            <div class="info">
                                <h1>"Sea Secrets Unveiled: The Hidden Treasures of Seagrass Meadows"</h1>
                                <hr>
                                <p class="text">Seagrasses play a vital role in marine ecosystems and provide numerous
                                    benefits to the environment. Here are some of the key importance of seagrasses:
                                    <br><br>
                                    1. <strong style="font-size: 1.4rem;">Habitat and Biodiversity:</strong> Seagrasses
                                    serve as essential habitats for a diverse range of marine species, including fish,
                                    invertebrates, and other marine organisms. They provide shelter, breeding grounds,
                                    and food sources for many marine animals, contributing to the overall biodiversity
                                    of coastal and marine ecosystems. <br>
                                    2. <strong style="font-size: 1.4rem;">Carbon Sequestration:</strong> Seagrasses are
                                    highly efficient at capturing and storing carbon dioxide from the atmosphere through
                                    photosynthesis. They play a crucial role in carbon sequestration, helping to
                                    mitigate climate change by reducing the levels of greenhouse gases in the
                                    atmosphere. <br>
                                    3. <strong style="font-size: 1.4rem;">Coastal Protection:</strong> Seagrasses help
                                    stabilize coastlines and reduce coastal erosion by trapping sediments with their
                                    roots and rhizomes. They act as natural barriers against storm surges, protecting
                                    shorelines from erosion and minimizing the impact of waves and currents. <br>
                                    4. <strong style="font-size: 1.4rem;">Water Quality:</strong> Seagrasses improve
                                    water quality by trapping sediments and nutrients, thereby reducing turbidity and
                                    preventing algal blooms. They act as natural filters, helping to maintain the
                                    clarity and quality of coastal waters. <br>
                                    5. <strong style="font-size: 1.4rem;">Economic Importance:</strong> Seagrasses
                                    support important commercial and recreational fisheries by providing essential
                                    habitats for fish and shellfish. They contribute to the livelihoods of coastal
                                    communities through fishing, tourism, and other economic activities. <br>
                                    6. <strong style="font-size: 1.4rem;">Oxygen Production:</strong> Like terrestrial
                                    plants, seagrasses produce oxygen as a byproduct of photosynthesis. They contribute
                                    to the oxygenation of marine environments, supporting the health and survival of
                                    marine organisms. <br>
                                    7. <strong style="font-size: 1.4rem;">Nursery Grounds:</strong> Seagrasses are
                                    crucial nursery grounds for many marine species, including commercially important
                                    fish species. Juvenile fish and other marine organisms find shelter and food in
                                    seagrass beds, which are essential for their growth and survival. <br>
                                    8. <strong style="font-size: 1.4rem;">Erosion Control:</strong> Seagrasses help
                                    prevent coastal erosion by stabilizing sediments with their roots and rhizomes. They
                                    play a vital role in maintaining the integrity of coastal ecosystems and protecting
                                    shorelines from the impacts of waves and currents. <br><br>
                                    Overall, seagrasses are invaluable components of coastal and marine ecosystems,
                                    providing a wide range of ecological, economic, and social benefits. Protecting and
                                    conserving seagrass habitats is essential for the health and sustainability of
                                    marine environments worldwide. <br>
                                </p>
                            </div>
                        </article>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <section class="section" id="contact"
        style="background-image: url('{{ asset('img/contact.png') }}'); background-size: cover;">
        <div class="container">
            <div class="left">
                <div class="form-wrapper">
                    <div class="contact-heading">
                        <div class="card text-white bg-transparent mb-3">
                            <div class="card-header">
                                <img src="{{ asset('img/bg1.png') }}" alt="logo">
                                <h1 class="text-white">Let's work together!</h1>
                            </div>
                            <div class="card-body">
                                <p class="text-white">Reach us via: <i class="fa fa-envelope"
                                        style="font-size:24px;color:white"></i> <strong><a
                                            href="https://mail.google.com/mail/?view=cm&fs=1&to=seagrass.nc2024@gmail.com"
                                            target="_blank">Seagrass.nc2024@gmail.com</a></strong></p>
                                <div class="social-icons"
                                    style="display: flex; justify-content: center; align-items: center; margin-top: 10px;">
                                    <a href="https://www.facebook.com/p/DENR-CENRO-APARRI-CAGAYAN-100067828756511/"
                                        target="_blank" class="m-2"><i class="fab fa-facebook-square"></i></a>
                                    <a href="https://twitter.com/Seagrass_" target="_blank" class="m-2"><i
                                            class="fab fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/seagrass_/" target="_blank" class="m-2"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Typing animation
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

        // Slideshow
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

        setInterval(() => {
            requestAnimationFrame(nextSlide);
        }, 3000);
    </script>
</body>

</html>
