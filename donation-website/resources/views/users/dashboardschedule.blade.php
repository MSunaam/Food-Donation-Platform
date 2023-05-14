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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
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
                    <a class="nav-link" href="{{ route('gotoschedule') }}">Schedule</a>
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


    <div class="row justify-content-around">
            

            

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Item Details</h5>
                </div>


                <form action="{{ route('add_scheduling') }}" method="post" id="addScheduling" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div id="questions">

                        <div class="row justify-content-center">
                            <label for="food_name" class="col-md-3 col-form-label mt-3">Food Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="food_name" name="food_name" placeholder="Food Name" required>
                                <label for="food_name" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="food_category" class="col-md-3 col-form-label mt-3">Food Category</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="food_category" name="food_category" placeholder="Category" required>
                                <label for="food_category" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="Pickup_date" class="col-md-3 col-form-label mt-3">Pickup Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control mt-3" id="Pickup_date" name="Pickup_date" placeholder="" required>
                                <label for="Pickup_date" class="error fail-alert"></label>
                            </div>
                        </div>


                        <div class="row justify-content-center">
                            <label for="pickup_time" class="col-md-3 col-form-label mt-3">pickup_time</label>
                            <div class="col-sm-6">
                                <input type="time" class="form-control mt-3" id="pickup_time" name="pickup_time" placeholder="" required>
                                <label for="pickup_time" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="status" class="col-md-3 col-form-label mt-3">Status</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="status" name="status" placeholder="" required>
                                <label for="status" class="error fail-alert"></label>
                            </div>
                        </div>
                        

                    </div>
                </form>



                <div class="modal-footer">
                    <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-orange" id="submitForm">Add Scheduling</button>
                </div>
            </div>
        </div>

        <span class="alert alert-success d-none" id="successInventoryMessage">Successfully Added</span>
    </div>
</div>
    







<!-- script for additem inventory  -->
<script>
    var addItems = document.getElementById('submitForm');

    var addItemButton = document.getElementById('addItemButton');
    addItemButton.addEventListener('click', function(){
        $('.modal-backdrop').show()
    })

    $("#addItem").validate({
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            food_name : {
                required: true,
                minlength: 3
            },
            food_category: {
                required: true,
                minlength: 3
            },
            expiration_date : {
                required: true,
                date: true
            },
            quantity : {
                required: true,
                number: true
            },
            unit: {
                required: true,
                minlength: 1,
            },
        },
        messages : {
            food_name : {
                required: 'Please enter name',
                minlength: 'Please enter at least 3 characters'
            },
            food_category: {
                required: 'Please enter category',
                min: 'Please enter at least 3 characters'
            },
            expiration_date : {
                required: 'Please enter an expiration date',
                date: 'Please enter a valid date'
            },
            quantity : {
                required: 'Please enter quantity',
                number: 'Please enter a valid number'
            },
            unit: {
                required: 'Please enter a unit',
                minlength: 'Please enter at least 1 character'
            },
        },
    });

    addItems.addEventListener('click', function(e) {
        e.preventDefault();
        var form = document.getElementById('addItem');
        var formData = new FormData(form);

        formData.set('foodBankId', '{{ Auth::user()->id }}');

        var myModalEl = document.querySelector('#staticBackdrop');
        var myModal = bootstrap.Modal.getOrCreateInstance(myModalEl);

        function hideSuccess () {
            $('#successInventoryMessage').addClass('d-none');
        }

        if($('#addItem').valid()){
            $.ajax({
                url: "{{ route('add_item') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response['error'] === false){

                        $('#successInventoryMessage').removeClass('d-none');


                        var timeout = setTimeout(hideSuccess, 1000);
                        // clearTimeout(timeout);


                        myModal.hide();
                        $('.modal-backdrop').hide()
                    }

                },
                error: function (response) {
                    console.log(response);
                    

                }
            })
        }

    });

</script>



</body>
</html>
