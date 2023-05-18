<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        MealShare
    </title>
    <x-favicon/>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <x-bootstrap-css/>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</head>

<body>

{{--Navbar Component--}}
@auth
    {{--Navbar Component--}}
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
                        <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contact Us</a>
                    </li>
                </ul>
                <div class="nav-item dropdown mx-5">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/food-bank.png') }}" class="rounded-circle align-middle mb-2" width="30px" height="30px">
                        <span class=>{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <img src="{{ asset('images/setting.png') }}" class="rounded-circle" width="20px" height="20px">
                                Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <img src="{{ asset('images/logout.png') }}" class="rounded-circle" width="20px" height="20px">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
@else
<x-navbar active="home" />
@endauth

<div class="container-fluid">
    <img src="{{ asset('images/home-image.jpg') }}" class="img-fluid d-block" style="max-width: 80%; z-index: 0" alt="Image" id="bg-image">
    <div id="text-over-img">
        <p class=" h1" id="home-pic-caption">Donate to save lives</p>
        <p class="lead">At MealShare, we believe that good food should never go to waste, especially when millions go hungry every day. Our innovative platform bridges the gap between food surpluses and scarcity, connecting restaurants, grocery stores, food banks, and other charitable organizations to create a more sustainable and equitable food system.</p>
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
            <span id ="donationlottie"><lottie-player  src="https://assets10.lottiefiles.com/packages/lf20_hytsx9gs.json" background="transparent" speed="1" style="width:600px; height: 600px;" loop autoplay></lottie-player></span>
        </div>
    </div>
</div>

</body>

<script>
    var loginButton = document.getElementById('loginButton');
    loginButton.addEventListener('click', function() {
        window.location.href = "{{ route('login') }}";
    });
    var registerButton = document.getElementById('registerButton');
    registerButton.addEventListener('click', function() {
        window.location.href = "{{ route('registerUser') }}";
    });
</script>

</html>
