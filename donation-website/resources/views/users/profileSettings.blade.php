<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile-MealShare</title>
    <x-favicon/>
</head>

{{--Style--}}
<x-bootstrap-css/>
<link href="{{ asset("css/theme.css") }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/profile.css') }}" rel="stylesheet" type="text/css">

{{--<link rel="stylesheet" href="{{ asset('css/profile.css') }}" type="text/css">--}}

{{--Scripts--}}
<x-ajax/>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

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
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1"">Contact Us</a>
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

<div class="container-fluid mt-5">
    <div class="text-start" id="profileHeading">
        <span class="display-6">Profile</span>
    </div>
</div>

<div class="container justify-content-around" id="mainDiv">
    <div class="row justify-content-around">

        <form action="{{ route('update_profile') }}" method="post" id="updateProfileForm" autocomplete="on" class="needs-validation" novalidate>
            @csrf
            <div id="updateProfileQuestions">

                <div class="row justify-content-center">
                    <label for="name" class="col-md-3 col-form-label mt-3">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control mt-3" id="name" name="name" value="{{ Auth::user()->name }}" required>
                        <label for="name" class="error fail-alert"></label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <label for="old_password" class="col-md-3 col-form-label mt-3">Old Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control mt-3" id="old_password" name="old_password" placeholder="" required>
                        <label for="old_password" class="error fail-alert"></label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <label for="password" class="col-md-3 col-form-label mt-3">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control mt-3" id="password" name="password" placeholder="" required>
                        <label for="password" class="error fail-alert"></label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <label for="confirm_password" class="col-md-3 col-form-label mt-3">Confirm Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control mt-3" id="confirm_password" name="confirm_password" placeholder="" required>
                        <label for="confirm_password" class="error fail-alert"></label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <label for="address" class="col-md-3 col-form-label mt-3">Address</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control mt-3" id="address" name="confirm_password" value="{{ Auth::user()->address }}" required>
                        <label for="address" class="error fail-alert"></label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <label for="city" class="col-md-3 col-form-label mt-3">City</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control mt-3" id="city" name="confirm_password" value="{{ Auth::user()->city }}" required>
                        <label for="city" class="error fail-alert"></label>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <label for="phone_number" class="col-md-3 col-form-label mt-3">Phone Number</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control mt-3" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" required>
                        <label for="phone_number" class="error fail-alert"></label>
                    </div>
                </div>

            </div>
            <button class="btn btn-orange mb-1" id="changesettings" style="float:right;">Change</button>

        </form>

    </div>
</div>
<script>
    var changeSettingButton = document.getElementById('changesettings');

changeSettingButton.addEventListener('click', function (e) {
    e.preventDefault();
    var changeForm = document.getElementById('updateProfileForm');
    var settingFormData = new FormData(changeForm);

    console.log(settingFormData);

    if ($('#updateProfileForm').valid()) {
        $.ajax({
            url: "{{ route('update_profile') }}",
            type: "POST",
            data: settingFormData,
            processData: false,
            contentType: false,
            success: function (response) {

                console.log(response);

                // $('#successUpdateMessage').removeClass('d-none');

                var timeout = setTimeout(hideUpdate, 2000);
                // clearTimeout(timeout);


                // myModal3.hide();
                // $('#scheduleError').addClass('d-none');
                // $('.modal-backdrop').hide();

            },
            // error: function (response) {
            //     console.log(response);
            //     // console.log(response);
            //     var errors = response.responseJSON.errors;
            //     // console.log(errors);
            //     var errorDiv = document.querySelector("#markScheduleError");
            //     errorDiv.classList.remove('d-none');
            //     errorDiv.style.color = 'red';

            //     for (var key in errors) {
            //         errorDiv.innerHTML = errors[key][0];
            //         errorDiv.classList.remove('d-none');
            //         break;

            //     }
            // }

        });

    }

});

// $('#scheduleError').addClass('d-none');
</script>

</body>
</html>
