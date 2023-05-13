<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-MealShare</title>
    <x-favicon/>

{{--    Styles--}}
    <x-bootstrap-css/>
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet" type="text/css">
{{--    Scripts--}}
    <x-ajax/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>

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
                    <a class="nav-link" aria-current="page" href="#">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Contact Us</a>
                </li>
            </ul>
            <div class="nav-item dropdown mx-5">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/food-bank.png') }}" class="rounded-circle align-middle mb-2" width="30px" height="30px">
                     <span class=>{{ Auth::user() ? Auth::user()->name : "Sunaam" }}</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a class="dropdown-item" href="#">
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

<div class="container-fluid mt-5">
    <div class="text-center">
         <span class="display-6">Welcome, {{ Auth::user() ? Auth::user()->name : "Sunaam" }}</span>
    </div>
</div>

<div class="container justify-content-around" id="dashboardInformation">
    <div class="row justify-content-around">
        <div class="col-md-5 m-1 borderShadow" id="inventoryInformation">
            <span class="lead">Inventory</span>
            <div class="container-fluid" id="inventory">

            </div>
        </div>
        <div class="col-md-5 m-1 borderShadow" id="scheduleInformation">
            <span class="lead">Schedule</span>
        </div>
    </div>
</div>


</body>
</html>
