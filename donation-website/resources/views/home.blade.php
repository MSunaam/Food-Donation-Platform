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
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

</head>

<body>

{{--Navbar Component--}}
<x-navbar active="home" />

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

<script>
    var loginButton = document.getElementById('loginButton');
    loginButton.addEventListener('click', function() {
        window.location.href = "{{ route('loginUser') }}";
    });
    var registerButton = document.getElementById('registerButton');
    registerButton.addEventListener('click', function() {
        window.location.href = "{{ route('registerUser') }}";
    });
</script>

</html>
