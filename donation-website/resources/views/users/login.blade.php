<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-MealShare</title>
    <x-favicon/>
    {{--    Styles--}}
    <x-bootstrap-css/>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet" type="text/css">
    {{--    Scripts--}}
    <x-lottie/>
    <x-ajax/>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</head>
<body>

<div class="d-flex flex-column min-vh-100 min-vw-100">
    <div class="d-flex flex-grow-1 justify-content-center align-items-center">
        <div class="w-50 h-50 justify-content-center flex-column text-center" id="registerBox">
            <div class="container m-3">
                <form action="{{ route('createUser') }}" method="post" id="loginForm" autocomplete="on" class="needs-validation" novalidate>
                @csrf

                    <div id="formFieldContainer">
                        <p class="display-5" id="heading">Login</p>
                        <div class="row justify-content-center">
                            <label for="email" class="col-md-3 col-form-label mt-3">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control mt-3" id="email" name="email" placeholder="yourEmail@meow.com" required>
                                <label for="email" class="error fail-alert"></label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <label for="password" class="col-md-3 col-form-label mt-3">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control mt-3" id="password" name="password" placeholder="" required>
                                <label for="password" class="error fail-alert"></label>
                            </div>
                        </div>
                        <div class="row mt-3 mx-3">
                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <button class="btn btn-green" id="submitForm">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="lead">
                    <a href="{{ route('registerUser') }}">Don't have an account?</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var submitButton = document.getElementById('submitForm');
    var form = document.getElementById('loginForm');
    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        var formData = new FormData(form);

        $.ajax({
            url: "{{ route('createUser') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                window.location.href = "{{ route('dashboard') }}";
            },
            error: function (response) {
                console.log(response);
                var errors = response.responseJSON.errors;
                var errorDiv = document.querySelector("#errorDiv");
                errorDiv.style.color = 'red';

                for(var key in errors){
                    errorDiv.innerHTML = errors[key][0];
                    errorDiv.classList.remove('d-none');
                    break;
                }

            }
        });

    });

</script>

</body>

</html>
