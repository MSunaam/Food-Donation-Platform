<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login-MealShare</title>
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

@auth
    <script>
        window.location.href = '{{ route('dashboard') }}';
    </script>
@endauth

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
                        <div class="row mt-4 mx-3">
                            <div class="row justify-content-end">
                                <div class="col-6">
                                    <button class="btn btn-green" id="submitForm">Login</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="alert d-none my-1" id="errorDiv"></p>

                </form>
                <div class="mt-3 text-start mx-2">
                    <span class="mx-2">Don't have an account?</span><a href="{{ route('registerUser') }}" id="registerButton">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var submitButton = document.getElementById('submitForm');
    var form = document.getElementById('loginForm');

    $("#loginForm").validate({
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            email: {
                required: true,
                email: true
            },
            password : {
                required: true,
                minlength: 8
            },
        },
        messages : {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email"
            },
            password : {
                required: "Please enter your password",
                minlength: "Password must be at least 8 characters long"
            },
        }
    });

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        var formData = new FormData(form);
        console.log(formData);

        if($('#loginForm').valid()){

            $.ajax({
                url: "{{ route('authenticate') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                Accept: 'application/json',
                success: function (response) {
                    // console.log(response);
                    window.location.href = "{{ route('dashboard') }}";
                },
                error: function (response) {
                    var errors = response.responseJSON.message;

                    var errorDiv = document.querySelector("#errorDiv");
                    errorDiv.style.color = 'red';

                    errorDiv.innerHTML = errors;
                    errorDiv.classList.remove('d-none');

                }
            });

        }

    });

</script>

</body>

</html>
