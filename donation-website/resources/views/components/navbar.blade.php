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
                    <a class="nav-link {{ $active == 'home' ? 'active' : '' }}" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'about us' ? 'active' : '' }}" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $active == 'contact us' ? 'active' : '' }}" href="#" tabindex="-1" aria-disabled="true">Contact Us</a>
                </li>
            </ul>
            <div class="d-flex">
                <button class="btn btn-orange mx-3 px-3" id="loginButton" onclick="{{ route('loginUser') }}">Login</button>
                <button class="btn btn-gunmetal" id="signUpButton">Sign Up</button>
            </div>
        </div>
    </div>
</nav>
