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
</head>
<body>

    <div class="d-flex flex-column min-vh-100 min-vw-100">
        <div class="d-flex flex-grow-1 justify-content-center align-items-center">
            <div class="w-50 h-50 justify-content-center flex-column text-center" id="registerBox">
                <div class="container m-3">
                    <form action="{{ route('createUser') }}" method="post" id="registerForm">
                        @csrf
                        <div class="mb-3" id="question1">
                            <p class="display-5">What do you want to register?</p>
                            <div class="row px-2 my-4">
                                <x-lottie-card id="foodBank" title="Food Bank" link="https://assets9.lottiefiles.com/packages/lf20_g6nvbpri.json"/>

                                <x-lottie-card id="restaurant" title="Restaurant" link="https://assets8.lottiefiles.com/packages/lf20_cbr1qxxq.json"/>

                                <x-lottie-card id="groceryStore" title="Grocery Store" link="https://assets7.lottiefiles.com/packages/lf20_iszpuyas.json" hover="autoplay"/>

                            </div>

                            <button class="btn btn-green" id="nextButton">Next</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

<script>
    var cards = document.getElementsByClassName("card");
    Array.from(cards).forEach(function (card) {
        card.addEventListener('click', function () {
            var classes = this.classList;
            if (classes.contains('cardZoom')) {
                Array.from(cards).forEach(function (card) {
                    card.classList.remove('selectedCard');
                });
                card.classList.toggle('selectedCard');
            } else {
                card.classList.remove('selectedCard');
            }
        });
    });
</script>

</body>
</html>
