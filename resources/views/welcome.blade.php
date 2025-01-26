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
                font-family: 'Arial', sans-serif;
            }
            .typing {
            font-family: 'Roboto', sans-serif; /* Replace with your desired font */
            font-size: 10px;
            color: #333; /* Set the desired text color */
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
            .back-video {
                width: 100%;
                height: 100%;
                object-fit: cover;
                position: absolute;
                top: 0;
                left: 0;
                z-index: 1;
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
                outline: none;
            }

            .home .content a:hover {
                background-color: limegreen;
                outline: none;
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
                font-size: 1em;
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
            .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.2); /* Semi-transparent background */
        backdrop-filter: blur(10px); /* Blur effect */
        -webkit-backdrop-filter: blur(10px); /* Safari support */
        z-index: 3;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
    }

    .navbar .nav-link {
        color: white;
        font-size: 1rem;
        padding: 10px 15px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .navbar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: black;
    }

    /* Responsive Design */
    .navbar-toggler {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
    }

    @media (max-width: 992px) {
        .navbar {
            padding: 10px 20px;
        }

        .navbar-toggler {
            display: block;
        }

        /* Initially hide the navbar links on smaller screens */
        .navbar-collapse {
            display: none;
        }

        /* Show navbar links when toggled */
        .navbar-collapse.show {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .nav-link {
            padding: 10px 20px;
            width: 100%;
            text-align: left;
        }
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

         /* Article Section */
/* Article Section */
#article {
    background-size: cover;
    background-position: center;
    padding: 50px 0;
}



.mission__container {
    padding: 20px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
}

.mission-vision {
    background-color: rgba(19, 125, 177); /* Slightly transparent background */
    text-align: center;
    border: 1px solid transparent;
    border-radius: 20px;
    width: 100%;
}

.info {
    padding: 2rem;
    font-family: 'Roboto', sans-serif; /* Apply a custom font family */
    letter-spacing: 0.5px; /* Reduce letter spacing */
}

.info h1 {
    font-weight: normal;
    color: white;
    font-size: 2.5rem;
    margin-bottom: 20px;
    letter-spacing: 0px; /* Default spacing for the heading */
}

.info hr {
    border: 1px solid white;
    margin: 20px 0;
}

.info p {
    font-size: 1.2rem;
    color: #fff;
    font-weight: 500;
    text-align: justify;
    line-height: 1.4; /* Adjust line height for better spacing */
    letter-spacing: 0.3px; /* Reduced letter spacing */
}

@media (max-width: 768px) {
    .info h1 {
        font-size: 2rem; /* Adjust heading size for smaller screens */
    }

    .info p {
        font-size: 1rem; /* Adjust paragraph size for smaller screens */
    }

    .mission__container {
        padding: 10px; /* Adjust padding for smaller screens */
    }
}

@media (max-width: 576px) {
    #article {
        padding: 20px 0; /* Less padding for mobile */
    }

    .info h1 {
        font-size: 1.8rem; /* Smaller heading for mobile */
    }

    .info p {
        font-size: 1rem; /* Adjust text size for mobile */
    }

    .mission__container {
        grid-template-columns: 1fr; /* Single column layout for mobile */
    }
}

/* Google Font Import */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        </style>
    </head>

    <body>
    <!-- Navbar -->
    <div class="navbar d-flex justify-content-between align-items-center">
        <!-- Navbar Links inside Collapsible Container -->
        <div class="collapse navbar-collapse d-lg-flex justify-content-center flex-grow-1" id="navbarNav">
            <a href="#home" class="nav-link">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="{{ route('map-guest') }}" class="nav-link">
                <i class="fas fa-map"></i> Map
            </a>
            <a href="#article" class="nav-link">
                <i class="fas fa-newspaper"></i> Article
            </a>
            <a href="#contact" class="nav-link">
                <i class="fas fa-envelope"></i> Contact Us
            </a>
        </div>

        <!-- Hamburger Menu Button -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
    </div>


            {{-- <div class="ml-auto" style="margin-right: 10px;">
                <a href="{{ route('login') }}" class="btn btn">Login</a>
            </div> --}}

        <section id="home" class="home section">
            <!-- Slideshow Section -->
            <div class="slideshow">
                <!-- Background Image -->
                <div class="slide active" style="background-image: url('{{ asset('img/welcomebgg.png') }}');"></div>
            </div>

            <!-- Content Section -->
            <div class="content text-center text-light">
                <h1 class="typing">Welcome to Seagrass Conservation</h1>
                <p class="mt-3">
                    Seagrasses play very important roles in marine ecosystems, and we need to conserve and take care of these
                    majestic species. Explore our website to learn more and discover how you can help protect these amazing plants.
                </p>
                <a href="{{ route('login') }}" class="btn-primary mt-3">
                    <i class="fas fa-sign-in-alt me-2"></i> {{ __('Get Started') }}
                </a>
            </div>

            <!-- Social Media Icons -->
            <div class="media-icons d-flex justify-content-center mt-4">
                <a href="https://www.facebook.com/p/DENR-CENRO-APARRI-CAGAYAN-100067828756511/" class="mx-2 text-light">
                    <i class="fab fa-facebook-square fa-2x"></i>
                </a>
                <a href="#" class="mx-2 text-light">
                    <i class="fab fa-twitter-square fa-2x"></i>
                </a>
                <a href="#" class="mx-2 text-light">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
            </div>
        </section>

        <!-- Article Section -->
        <section id="article" class="section" style="background-image: url('{{ asset('img/seagrass_image1.jpeg') }}'); background-size: cover; background-position: center; padding: 50px 0;">
            <div class="content">
                <div class="container">
                    <h1 class="Title text-center py-4">ARTICLE</h1>
                    <section class="mission">
                        <div class="mission__container">
                            <article class="mission-vision">
                                <div class="info">
                                    <h1>"Sea Secrets Unveiled: The Hidden Treasures of Seagrass Meadows"</h1>
                                    <hr>
                                    <p class="text">
                                        Seagrasses play a vital role in marine ecosystems and provide numerous benefits to the environment. Here are some of the key importance of seagrasses:
                                        <br><br>
                                        1. <strong style="font-size: 1.4rem;">Habitat and Biodiversity:</strong> Seagrasses serve as essential habitats for a diverse range of marine species...
                                        <br><br>
                                        2. <strong style="font-size: 1.4rem;">Carbon Sequestration:</strong> Seagrasses are highly efficient at capturing and storing carbon dioxide...
                                        <br><br>
                                        3. <strong style="font-size: 1.4rem;">Coastal Protection:</strong> Seagrasses help stabilize coastlines and reduce coastal erosion...
                                        <br><br>
                                        4. <strong style="font-size: 1.4rem;">Water Quality:</strong> Seagrasses improve water quality by trapping sediments...
                                        <br><br>
                                        5. <strong style="font-size: 1.4rem;">Economic Importance:</strong> Seagrasses support important commercial and recreational fisheries...
                                        <br><br>
                                        6. <strong style="font-size: 1.4rem;">Oxygen Production:</strong> Like terrestrial plants, seagrasses produce oxygen...
                                        <br><br>
                                        7. <strong style="font-size: 1.4rem;">Nursery Grounds:</strong> Seagrasses are crucial nursery grounds for many marine species...
                                        <br><br>
                                        8. <strong style="font-size: 1.4rem;">Erosion Control:</strong> Seagrasses help prevent coastal erosion by stabilizing sediments...
                                        <br><br>
                                        Overall, seagrasses are invaluable components of coastal and marine ecosystems, providing a wide range of ecological, economic, and social benefits...
                                    </p>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>
            </div>
        </section>


        <!-- Contact Section -->
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        const typingElement = document.querySelector('.typing');
    const staticText = 'Sea Grasses'; // Static part of the text
    const dynamicText = '  of Northern Cagayan'; // Part to type and erase
    let index = 0;
    let isTyping = true; // Determines whether to type or erase

    const type = () => {
        if (isTyping) {
            // Typing the text
            if (index < dynamicText.length) {
                typingElement.textContent = staticText + dynamicText.substring(0, index + 1);
                index++;
                setTimeout(type, 100);
            } else {
                isTyping = false; // Switch to erasing
                setTimeout(type, 1000); // Pause before erasing
            }
        } else {
            // Erasing the text
            if (index > 0) {
                typingElement.textContent = staticText + dynamicText.substring(0, index - 1);
                index--;
                setTimeout(type, 100);
            } else {
                isTyping = true; // Switch to typing
                setTimeout(type, 500); // Pause before typing again
            }
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
