<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donation-MealShare</title>

{{--    CSS--}}
    <x-bootstrap-css/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/donation.css') }}">

{{--    Script--}}
    <x-ajax/>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</head>
<body>

@if(!auth()->check())
    <script> window.location.href = "{{ route('login') }}" </script>
@endif

{{--Navbar Component--}}

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/food-bank.png') }}" alt="mealShare" width="30" height="24" class="d-inline-block align-text-top">
            MealShare
        </a>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('showInventory')}}">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="">Donation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('request') }}">Request</a>
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
    <div class="text-start">
        <span class="display-6" id="donationHeading">Donations</span>
    </div>
</div>

<div id="donationButtons" class="mt-3">

    <button class="btn btn-orange" id="newDonationButton">New Donation</button>
    <button class="btn btn-gunmetal" id="donationStatusButton">Change Status</button>

    <div class="dropdown d-inline-block">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="sortByDropDownButton" data-bs-toggle="dropdown" aria-expanded="false">
            Sort By
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" id="dateSort">Date</a></li>
            <li><a class="dropdown-item" id="statusSort">Status</a></li>
            <li><a class="dropdown-item" id="quantity">Quantity</a></li>
        </ul>
    </div>

</div>

<x-donations-modal/>
<x-mark-schedule/>

<div class="container justify-content-around mainDiv">
    <div class="row justify-content-around">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Donation Id</th>
                <th scope="col">Donor Name</th>
                <th scope="col">Food Name</th>
                <th scope="col">Food Category</th>
                <th scope="col">Status</th>
                <th scope="col">Scheduled Pickup Time</th>
            </tr>
            </thead>
            <tbody id="requestTableBody">

            @if($donations->isEmpty())
                <tr>
                    <td colspan="7" class="text-center"><span>No Requests</span></td>
                </tr>
            @else
                @foreach($donations as $request)
                    <tr>
                        <th scope="row">{{ $request->id }}</th>
                        <td>{{ $request->donor_name }}</td>
                        <td>{{ $request->food_name }}</td>
                        <td>{{ $request->food_category }}</td>
                        <td>{{ ucfirst(trans($request->status)) }}</td>
                        <td>{{ date('d-m-Y',strtotime($request->scheduled_pickup_time)) }}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>
</div>

<script>

    function formatDate(str) {
        var year = str.slice(0,4);
        var month = str.slice(5,7);
        var day = str.slice(8,10);
        return day + '-' + month + '-' + year;
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    var changeStatusModalEl = document.getElementById('modal3');
    var changeStatusModal = bootstrap.Modal.getOrCreateInstance(changeStatusModalEl);

    changeStatusModalEl.addEventListener('hidden.bs.modal', function (event) {
        refreshTable();
    })

    var changeStatusModalButton = document.getElementById('donationStatusButton');
    changeStatusModalButton.addEventListener('click',function(e){
        e.preventDefault();
        changeStatusModal.show();
    });

    var changeStatusButton = document.getElementById('mark_schedule_form');
    changeStatusButton.addEventListener('click', function(e){
        e.preventDefault();
        var form = document.getElementById('mark_schedule_form');
        var formData = new FormData(form);
        o
    });


    var donationModalEl = document.getElementById('modal2');
    var donationModal = bootstrap.Modal.getOrCreateInstance(donationModalEl);

    var newDonationButton = document.getElementById('newDonationButton');

    newDonationButton.addEventListener('click', function () {
        donationModal.show();
    })

    var addDonation = document.getElementById('addDonation');

    var donationForm = document.getElementById('add_donation_form');

    var tableBody = document.getElementById('requestTableBody');

    var refreshTable = function(sortBy = null) {
        $.ajax({
            url: "{{ route('donationHistory') }}",
            type: 'GET',
            success: function (data) {

                data = data.donations;

                if(sortBy === "status"){
                    data.sort(function(a, b){
                        var x = a.status.toLowerCase();
                        var y = b.status.toLowerCase();
                        if (x < y) {return -1;}
                        if (x > y) {return 1;}
                        return 0;
                    });
                }
                else if(sortBy === "date"){
                    data.sort(function(a, b){
                        var x = a.scheduled_pickup_time.toLowerCase();
                        var y = b.scheduled_pickup_time.toLowerCase();
                        if (x < y) {return -1;}
                        if (x > y) {return 1;}
                        return 0;
                    });
                }
                else if(sortBy === "donorName"){
                    data.sort(function(a, b){
                        var x = a.donor_name.toLowerCase();
                        var y = b.donor_name.toLowerCase();
                        if (x < y) {return -1;}
                        if (x > y) {return 1;}
                        return 0;
                    });
                }

                requestTableBody.innerHTML = "";
                if(data.length === 0){
                    tableBody.innerHTML = "<tr><td colspan='7' class='text-center'><span>No Requests</span></td></tr>";
                }
                else{
                    data.forEach(function (donation) {
                        var row = document.createElement('tr');
                        row.innerHTML = "<th scope='row'>" + donation.id + "</th>" +
                            "<td>" + donation.donor_name + "</td>" +
                            "<td>" + donation.food_name + "</td>" +
                            "<td>" + donation.food_category + "</td>" +
                            "<td>" + capitalizeFirstLetter(donation.status) + "</td>" +
                            "<td>" + formatDate(donation.scheduled_pickup_time) + "</td>";
                        tableBody.appendChild(row);
                    });
                }

            },
            error: function (data) {
                console.log(data);
            }
        });
    }

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

    addDonation.addEventListener('click', function(){

        var formData = new FormData(donationForm);
        formData.append(
            "receiver_id", "{{ Auth::user()->id }}"
        );

        if($("#add_donation_form").valid()) {
            $.ajax({
                url: "{{ route('add_donation') }}",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                   console.log(response);
                     donationModal.hide();
                },
                error: function (response) {
                    var errorDiv =  document.getElementById('scheduleError');
                    errorDiv.innerHTML = "";
                    errorDiv.classList.remove('d-none');
                    for(var key in response.responseJSON.errors){
                        document.getElementById('scheduleError').innerHTML += "<p>" + response.responseJSON.errors[key] + "</p>";
                    }

                }
            })
        }

    })

    donationModalEl.addEventListener('hidden.bs.modal', function () {
        refreshTable();
        document.getElementById('scheduleError').classList.add('d-none');
    })




</script>

</body>
</html>
