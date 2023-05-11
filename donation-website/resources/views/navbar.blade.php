<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            MealShare
        </title>
        <link rel="icon" type="image/x-icon" href="{{ asset('images/food-bank.png') }}">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    </head>

    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="{{ asset('images/food-bank.png') }}" alt="mealShare" width="30" height="24" class="d-inline-block align-text-top">
                MealShare
            </a>
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <button class="btn btn-orange mx-3 px-3" id="loginButton" onclick="{{ route('loginUser') }}">Login</button>
                    <button class="btn btn-gunmetal" id="signUpButton">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <img src="{{ asset('images/home-image.jpg') }}" class="img-fluid d-block" style="max-width: 80%; z-index: 0" alt="Image" id="bg-image">
        <div id="text-over-img">
            <p class=" h1" id="home-pic-caption">Donate to save lives</p>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <button class="btn btn-green" id="get-started-btn">Get Started</button>
        </div>
    </div>

    <div class="container-fluid text-center">
        <p class="display-1">Our Mission</p>
    </div>

    <br>

    <div class="container">
        <div class="row">
            <div class="col" id="missionText">
                <p class="lead">Our mission at MealShare is to connect restaurants, grocery stores, food banks, and charitable organizations in a seamless and efficient manner, fostering a community dedicated to reducing food waste and ensuring access to nutritious meals for those in need. We strive to empower businesses and organizations to make a tangible impact by streamlining food donations, promoting sustainability, and raising awareness about the importance of food security. Through our innovative platform, we aim to inspire collective action and create a world where everyone has the resources to live a healthy, nourished life.</p>
            </div>



        </div>


    </div>

    </body>

    <script src="{{ asset('js/home.js') }}"></script>

</html>
