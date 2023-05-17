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
                    <a class="nav-link" href="{{ route('showinventory') }}">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1">Contact Us</a>
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

<x-delete-account-modal/>

<div class="container-fluid mt-5">
    <div class="text-start" id="profileHeading">
        <span class="display-6">Profile</span>
    </div>
</div>

<div class="container justify-content-around mainDiv" id="detailsDiv">
    <div class="row justify-content-center">

        <p class="text-center h3">Details</p>
        <hr>

        <div class="col-md-6">

            <br>
            <p>Name: {{ Auth::user()->name }}</p>
            <p>Email: {{ Auth::user()->email }}</p>
            <p>Address: {{ Auth::user()->address }}</p>
            <p>City: {{ Auth::user()->city }}</p>
            <p>Phone Number: {{ Auth::user()->phone_number }}</p>
            <button class="btn btn-orange" id="detailsFormButton">Change Details</button>
        </div>



        <div class="col-md-6">
            <br>
            <p>User Since: {{ date('d-m-Y', strtotime(Auth::user()->created_at)) }}</p>
            <button class="btn btn-red" id="deleteAccount">Delete Account</button>
        </div>

    </div>

</div>

<div class="container justify-content-around d-none mainDiv" id="formDiv">
    <div class="row justify-content-center">

        <p class="text-center h3">Update Profile</p>
        <hr>

        <x-profile-change-form />

    </div>
</div>






<script>

    var deleteAccount = document.getElementById('deleteAccount');
    deleteAccount.addEventListener('click',function(e){
        e.preventDefault();
        $('#deleteAccountModal').modal('show');
    });

    var deleteAccountButton = document.getElementById('deleteAccountButton');
    deleteAccountButton.addEventListener('click',function(e){
        e.preventDefault();
        $('#deleteAccountModal').modal('hide');
        $('#deleteAccountForm').submit();
    });

    var detailsFormButton = document.getElementById('detailsFormButton');

    detailsFormButton.addEventListener('click',function(e){
        e.preventDefault();
        $('#formDiv').toggleClass('d-none');
    });

    var errorDiv = document.getElementById('errorDiv');
    console.log(errorDiv)

    var updateProfileForm = document.getElementById('updateProfileForm');
    var updateProfileFormButton = document.getElementById('updateProfileFormButton');

    var updateAlert = document.querySelector('#updateAlert');

    $('#updateProfileForm').validate({
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            old_password: {
                required: true,
                minlength: 8,
            },
            address: {
                required: true,
                minlength: 3,
            },
            phone_number: {
                required: true,
                minlength: 10,
                number: true,
            },
            city: {
                required: true,
                minlength: 3,
            },
        },
        messages : {
            name: {
                required: 'Please enter your name',
                minlength: 'Name must be at least 3 characters long',
            },
            old_password: {
                required: 'Please enter your old password',
                minlength: 'Password must be at least 8 characters long',
            },
            address: {
                required: 'Please enter your address',
                minlength: 'Address must be at least 3 characters long',
            },
            phone_number: {
                required: 'Please enter your phone number',
                minlength: 'Phone number must be at least 10 characters long',
                number: "Please enter a valid phone number"
            },
            city: {
                required: 'Please enter your city',
                minlength: 'City must be at least 3 characters long',
            },

        },
    });

    updateProfileFormButton.addEventListener('click',function(e) {
        e.preventDefault();
        var formData = new FormData(updateProfileForm);

        if ($('#updateProfileForm').valid()) {
            $.ajax({
                url: "{{ route('updateProfile') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    updateAlert.classList.remove('d-none');
                    updateAlert.classList.add('d-inline-block');

                    $("#password").val("");
                    $("#old_password").val("");
                    $("#confirm_password").val("");

                    setTimeout(function (){
                        updateAlert.classList.remove('d-inline-block');
                        updateAlert.classList.add('d-none');
                    }, 2000);

                },
                error: function (response) {
                    console.log(response);
                    errorDiv.innerHTML = '';
                    errorDiv.classList.remove('d-none');
                    var errors = response.responseJSON.message;
                    errorDiv.innerHTML += '<p class="text-center">'+ errors +'</p>';
                }
            });
        }

    });

</script>

</body>
</html>
