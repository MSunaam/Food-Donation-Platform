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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
{{--    Pie Chart--}}


</head>
<body>

{{--Navbar Component--}}

{{--{{ $schedules }}--}}

{{--@if(Auth::user()->user_type != 'food_bank')--}}
{{--    <script> window.location.href = "{{ route('home') }}" </script>--}}
{{--@endif--}}

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

            <button class="btn btn-gunmetal mb-1 mx-1" id="addItemButton" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Items</button>
            <x-inventory-modal/>

            <span class="alert alert-success d-none" id="successInventoryMessage">Successfully Added</span>

            <div class="row justify-content-center mt-3">
                <canvas id="myChart" width="300px"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>

                var arrQuantity = [];
                var arrName = [];

                @foreach($quantities as $quantity)
                arrQuantity.push({{ $quantity->quantity }});
                arrName.push('{{ $quantity->food_category }}');
                // arrName
                @endforeach

                const ctx = document.getElementById('myChart');

                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        // labels: ['Produce', 'Grains', 'Dairy', 'Meat', 'Packaged', 'Beverages', 'Condiments', 'Frozen'],
                        labels : arrName,
                        datasets: [{
                            label: 'Food Quantity',
                            // data: [12, 19, 3, 5, 2, 3],
                            data: arrQuantity,
                            borderWidth: 1
                        }]
                    },
                    options : {
                        responsive: false
                    }
                });
            </script>
        </div>

        <div class="col-md-5 m-1 borderShadow " id="scheduleInformation">
            <span class="lead">Schedule</span>

            <button class="btn btn-gunmetal mb-1 mx-1" id="addScheduleButton" data-bs-toggle="modal2" data-bs-target="#modal2">Schedule</button>
            <button class="btn btn-orange mb-1" id="completeScheduleButton">Mark Complete</button>
            <x-schedule-modal/>

            <span class="text-end blockquote-footer">Latest ten</span>

            <span class="alert alert-success d-none" id="successScheduleMessage">Successfully Added</span>
            <span class="alert alert-success d-none" id="successUpdateMessage">Successfully Updated</span>

            <div class="container-fluid my-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Donation Id</th>
                        <th scope="col">Food Name</th>
                        <th scope="col">Donor Name</th>
                        <th scope="col">Status</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($schedules as $schedule)

                        <tr>
                            <th scope="row">{{ $schedule->donations_id }}</th>
                            <td>{{ $schedule->food_name }}</td>
                            <td>{{ $schedule->donor_name }}</td>
                            <td>{{ ucfirst($schedule->status) }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

            <x-mark-schedule/>


        </div>
    </div>
</div>

<script>

    var modal3Button = document.getElementById('completeScheduleButton');
    var myModalEl3 = document.querySelector('#modal3');
    var myModal3 = bootstrap.Modal.getOrCreateInstance(myModalEl3);

    myModalEl3.addEventListener('hidden.bs.modal', function (){
        $('#markScheduleError').addClass('d-none');
    });

    modal3Button.addEventListener('click', function (e){
        e.preventDefault();

        $('.modal_backdrop').show();
        myModal3.show();

    });

    function hideUpdate(){
        $('#successUpdateMessage').addClass('d-none');
    }

    $("#mark_schedule_form").validate({
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            donation_id : {
                required: true,
                number: true
            },
            status : {
                required: true,
            },
            actual_pickup_time : {
                required: true,
            }
        },

        messages : {
            donation_id : {
                required: 'Please enter Donation Id',
                number: 'Please enter a number'
            },
            status : {
                required: 'Please enter a status',
            },
            actual_pickup_time : {
                required: 'Please enter a time',
            }
        }

    });

    var changeScheduleButton = document.getElementById('changeStatus');

    changeScheduleButton.addEventListener('click', function (e) {
        e.preventDefault();
        var scheduleForm = document.getElementById('mark_schedule_form');
        var scheduleFormData = new FormData(scheduleForm);

        console.log(scheduleFormData);

        if ($('#mark_schedule_form').valid()) {
            $.ajax({
                url: "{{ route('mark_schedule') }}",
                type: "POST",
                data: scheduleFormData,
                processData: false,
                contentType: false,
                success: function (response) {

                    console.log(response);

                    $('#successUpdateMessage').removeClass('d-none');

                    var timeout = setTimeout(hideUpdate, 2000);
                    // clearTimeout(timeout);


                    myModal3.hide();
                    $('#scheduleError').addClass('d-none');
                    $('.modal-backdrop').hide();

                },
                error: function (response) {
                    console.log(response);
                    // console.log(response);
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    var errorDiv = document.querySelector("#markScheduleError");
                    errorDiv.classList.remove('d-none');
                    errorDiv.style.color = 'red';

                    for (var key in errors) {
                        errorDiv.innerHTML = errors[key][0];
                        errorDiv.classList.remove('d-none');
                        break;

                    }
                }

            });

        }

    });

    $('#scheduleError').addClass('d-none');

    var modal2Button = document.getElementById('addScheduleButton');

    var myModalEl2 = document.querySelector('#modal2');
    var myModal2 = bootstrap.Modal.getOrCreateInstance(myModalEl2);

    myModalEl2.addEventListener('hidden.bs.modal', function (){
        $('#scheduleError').addClass('d-none');
    });

    modal2Button.addEventListener('click', function() {
        $('.modal-backdrop').show();
        myModal2.show();
    });


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

        // console.log(formData);

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


                        var timeout = setTimeout(hideSuccess, 2000);
                        // clearTimeout(timeout);


                        myModal.hide();
                        $('#scheduleError').addClass('d-none');
                        $('.modal-backdrop').hide()
                    }

                },
                error: function (response) {
                    console.log(response);
                    // var errors = response.responseJSON.errors;
                    // var errorDiv = document.querySelector("#errorDiv");
                    // errorDiv.style.color = 'red';
                    //
                    // for(var key in errors){
                    //     errorDiv.innerHTML = errors[key][0];
                    //     errorDiv.classList.remove('d-none');
                    //     break;
                    // }

                }
            })
        }

    });



    $("#add_donation_form").validate({
        errorClass: 'error fail-alert',
        validClass: 'valid success-alert',
        rules: {
            donor_id : {
                required: true,
                number: true,
            },
            food_name: {
                required: true,
                minlength: 3,
            },
            status : {
                required: true,
            },
            scheduled_pickup_time : {
                required: true,
            }
        },
        messages : {
            donor_id : {
                required: 'Please enter a Donor Id',
                number: 'Please enter a number',
            },
            food_name: {
                required: 'Please enter food name',
                minlength: 'Please enter at least 3 characters',
            },
            status : {
                required: 'Please select a status',
            },
            scheduled_pickup_time : {
                required: 'Please enter a pickup time',
            }
        }
    });

    function hideSuccessSchedule () {
        $('#successScheduleMessage').addClass('d-none');
    }


    var addDonation = document.getElementById('addDonation');
    addDonation.addEventListener('click', function(e){
        e.preventDefault();

        if($('#add_donation_form').valid()){

            var formSchedule = document.getElementById('add_donation_form');
            var formDataSchedule = new FormData(formSchedule);

            formDataSchedule.append('receiver_id', '{{ Auth::user()->id }}');

            $.ajax({
                url: "{{ route('add_donation') }}",
                type: "POST",
                data: formDataSchedule,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response['error'] === false){

                        $('#successScheduleMessage').removeClass('d-none');


                        var timeout = setTimeout(hideSuccessSchedule, 2000);
                        // clearTimeout(timeout);


                        myModal2.hide();
                        $('.modal-backdrop').hide()
                    }

                },
                error: function (response) {
                    // console.log(response);
                    var errors = response.responseJSON.errors;
                    // console.log(errors);
                    var errorDiv = document.querySelector("#scheduleError");
                    errorDiv.classList.remove('d-none');
                    errorDiv.style.color = 'red';

                    for(var key in errors){
                        errorDiv.innerHTML = errors[key][0];
                        errorDiv.classList.remove('d-none');
                        break;
                    }

                }
            })

        }


    });




</script>


</body>
</html>
