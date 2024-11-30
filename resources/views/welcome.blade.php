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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
}

/* Home Section */
.home {
    position: relative;
    width: 100%;
    height: 100vh; /* Ensures it fills the entire viewport */
    display: flex;
    justify-content: center;
    align-items: center; /* Centers content vertically and horizontally */
    flex-direction: column;
    background: whitesmoke;
    overflow: hidden; /* Hides any extra content */
}

/* Slideshow */
.slideshow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* Ensures slideshow matches the section height */
    z-index: 1;
    overflow: hidden;
}

.slide {
    position: absolute;
    width: 100%;
    height: 100%; /* Ensures each slide fills the section */
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
    text-align: center; /* Center the text */
}

.home .content h1 {
    font-size: 70px; /* Adjusted for better responsiveness */
    font-weight: 900;
    text-transform: uppercase;
    letter-spacing: 5px;
    line-height: 80px;
    margin-bottom: 20px;
    color: #DC8516;
    text-shadow:
        -1px -1px 0 #fff,
        1px -1px 0 #fff,
        -1px 1px 0 #fff,
        1px 1px 0 #fff;
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
        font-size: 40px; /* Adjust for smaller screens */
        line-height: 50px;
    }

    .home .content p {
        font-size: 16px; /* Adjust paragraph size */
    }

    .home .content a {
        padding: 10px 20px; /* Adjust button padding */
    }

    .home .media-icons {
        right: 10px; /* Adjust position */
    }
}

@media (max-width: 480px) {
    .home .content h1 {
        font-size: 30px; /* Further adjust for very small screens */
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

    </style>
</head>

<body>
    <section class="home">
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
            <a href="https://www.facebook.com/p/DENR-CENRO-APARRI-CAGAYAN-100067828756511/"><i class="fab fa-facebook-square"></i></a>
            <a href="#"><i class="fab fa-twitter-square"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
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
