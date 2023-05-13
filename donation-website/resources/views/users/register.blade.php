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
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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
                    <form action="{{ route('createUser') }}" method="post" id="registerForm" autocomplete="on" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3" id="question1">
                            <p class="display-5" id="heading">What do you want to register?</p>
                            <div class="row px-2 my-4">
                                <x-lottie-card id="foodBank" title="Food Bank" link="https://assets9.lottiefiles.com/packages/lf20_g6nvbpri.json"/>

                                <x-lottie-card id="restaurant" title="Restaurant" link="https://assets8.lottiefiles.com/packages/lf20_cbr1qxxq.json"/>

                                <x-lottie-card id="groceryStore" title="Grocery Store" link="https://assets7.lottiefiles.com/packages/lf20_iszpuyas.json" hover="autoplay" speed="0.7"/>

                            </div>

                            <button class="btn btn-green px-4" id="nextButton">Next</button>
                        </div>

                        <x-register-form/>

                    </form>

                    <p class="lead alert d-none my-3" id="errorDiv"></p>


                </div>

            </div>
        </div>
    </div>

<script>

    var form = document.getElementById("registerForm");

    var question1 = document.querySelector("#question1");

    var question2 = document.querySelector("#question2");
    question2.style.display = "none";

    var cards = document.getElementsByClassName("card");
    Array.from(cards).forEach(function (card1) {
        card1.addEventListener('click', function () {

            Array.from(cards).forEach(function (card) {
                if(card !== card1)
                    card.classList.remove('selectedCard');
            });
            card1.classList.toggle('selectedCard');
        });
    });

    function convertCamelCaseToNormal(string = "") {
        // Split the string into an array of words
        const words = string.match(/[A-Za-z][a-z]*/g);
        if(!words)
            return string;

        // Capitalize the first letter of each word and join them together
        return words.map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
    }

    title = '';

    var nextButton = document.getElementById("nextButton");
    nextButton.addEventListener('click', function (e){
        e.preventDefault();
        var selectedCard = document.getElementsByClassName('selectedCard')[0];
        if(selectedCard === undefined)
            return;
        title = selectedCard.getAttribute('id');
        question1.classList.add('d-none');
        var formData = new FormData(document.querySelector('form'));
        formData.set('user_type', convertCamelCaseToNormal(title));
        form.style.display = "none";
        question2.style.display = "block";
        $('#registerForm').delay(500).fadeIn('swing');
        $('#name').attr('placeholder', "Awesome " + convertCamelCaseToNormal(title));
    });

    var submitButton = document.getElementById("submitForm");

    // console.log(submitButton);

    $("#registerForm").validate({
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            name : {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password : {
                required: true,
                minlength: 8
            },
            confirm_password : {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
            address: {
                required: true,
                minlength: 3
            },
            phone: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
        },
        messages : {
            name : {
                required: "Please enter name",
                minlength: "Name must be at least 3 characters long"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email"
            },
            password : {
                required: "Please enter your password",
                minlength: "Password must be at least 8 characters long"
            },
            confirm_password : {
                required: "Please enter your password",
                minlength: "Password must be at least 8 characters long",
                equalTo: "Passwords do not match"
            },
            address: {
                required: "Please enter your address",
                minlength: "Address must be at least 3 characters long"
            },
            phone: {
                required: "Please enter your phone number",
                minlength: "Phone number must be 10 digits long",
                maxlength: "Phone number must be 10 digits long",
                number: "Please enter a valid phone number"
            },
        }
    });

    submitButton.addEventListener('click', function (e) {
        e.preventDefault();
        // if(!form.checkValidity()){
        //     // e.preventDefault();
        //     // e.stopPropagation();
        // }
        // form.classList.add('was-validated');});
        var formData = new FormData(document.querySelector('form'));
        formData.set('user_type', (title));
        console.log(formData);
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
