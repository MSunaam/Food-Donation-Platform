<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Request-MealShare</title>
    <x-favicon/>
{{--    CSS--}}
    <x-bootstrap-css/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/request.css') }}">
{{--    Script--}}
    <x-ajax/>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand">
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
                    <a class="nav-link active" href="{{ route('request') }}">Request</a>
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
        <span class="display-6" id="requestHeading">Requests</span>
    </div>
</div>

<div class="mt-3">
    <button class="btn btn-orange" id="newRequestButton">New Request</button>
    <button class="btn btn-gunmetal" id="changeStatusButton">Change Status</button>

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

<x-change-request-status-modal/>
<x-new-request-modal/>

<div class="container justify-content-around mainDiv" id="detailsDiv">
    <div class="row justify-content-center">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Request Id</th>
                <th scope="col">Food Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Request Date</th>
                <th scope="col">Status</th>
                <th scope="col">Note</th>
            </tr>
            </thead>
            <tbody id="requestTableBody">

           @if($history->isEmpty())
                <tr>
                    <td colspan="7" class="text-center"><span>No Requests</span></td>
                </tr>
            @else
                @foreach($history as $request)
                    <tr>
                        <th scope="row">{{ $request->id }}</th>
                        <td>{{ $request->food_category }}</td>
                        <td>{{ $request->quantity }}</td>
                        <td>{{ date('d-m-Y',strtotime($request->request_date)) }}</td>
                        <td>{{ ucfirst(trans($request->status)) }}</td>
                        <td>{{ $request->notes }}</td>
                    </tr>
                @endforeach
            @endif

            </tbody>
        </table>
    </div>
</div>

<script>

    $('#dateSort').click(function(){
        updateTable("date");
    });

    $('#statusSort').click(function(){
        updateTable("status");
    });

    $('#quantity').click(function(){
        updateTable("quantity");
    });

    var changeRequestModalEl = document.querySelector('#changeRequestStatusModal');
    var changeRequestModal = bootstrap.Modal.getOrCreateInstance(changeRequestModalEl);

    var changeStatusButton = document.querySelector('#changeStatusButton');
    changeStatusButton.addEventListener('click', function(e){
        e.preventDefault()
        changeRequestModal.show();
    });

    changeRequestModalEl.addEventListener('hidden.bs.modal', function (event) {
        updateTable();
    });

    $('#changeRequestStatusForm').validate([
        {
            rules: {
                request_id : {
                    required: true,
                    number: true
                },
                status: {
                    required: true
                },
                unit : {
                    required: true,
                    minLength: 1,
                },
                quantity : {
                    required: true,
                    number: true
                }
            },
            messages: {
                status: {
                    required: "Please select a status"
                },
                request_id : {
                    required: "Please enter a request id",
                    number: "Please enter a valid request id"
                },
                unit : {
                    required: "Please enter a unit",
                    minLength: "Please enter a valid unit"
                },
                quantity : {
                    required: "Please enter a quantity",
                    number: "Please enter a valid quantity"
                }
            }
        }
    ]);

    $('#newRequestForm').validate([
        {
            rules: {
                category : {
                    required: true,
                },
                status: {
                    required: true
                },
                unit : {
                    required: true,
                    minLength: 1,
                },
                quantity : {
                    required: true,
                    number: true
                }
            },
            messages: {
                status: {
                    required: "Please select a status"
                },
                request_id : {
                    required: "Please enter a request id",
                    number: "Please enter a valid request id"
                },
                unit : {
                    required: "Please enter a unit",
                    minLength: "Please enter a valid unit"
                },
                quantity : {
                    required: "Please enter a quantity",
                    number: "Please enter a valid quantity"
                }
            }
        }
    ]);

    var submitRequestChangeButton = document.querySelector('#submitRequestChangeButton');
    submitRequestChangeButton.addEventListener('click', function(e){
        e.preventDefault();

        var formData = new FormData(document.querySelector('#changeRequestStatusForm'));
        console.log(formData);

        if($('#changeRequestStatusForm').valid()) {
            $.ajax(
                {
                    url: "{{ route('updateRequest') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log(data);
                        changeRequestModal.hide();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                }
            );
        }
    });



    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function formatDate(str) {
        var year = str.slice(0,4);
        var month = str.slice(5,7);
        var day = str.slice(8,10);
        return day + '-' + month + '-' + year;
    }

    var requestTableBody = document.querySelector('#requestTableBody');

    var refreshTable = function (arr) {
        requestTableBody.innerHTML = '';

        (arr.forEach(function(entry){
            var writeHtml = '<tr>' +
                '<th scope="row">'+entry.id+'</th>' +
                '<td>'+entry.food_category+'</td>' +
                '<td>'+entry.quantity+'</td>' +
                '<td>'+ formatDate(entry.request_date) +'</td>' +
                '<td>'+capitalizeFirstLetter(entry.status)+'</td>' +
                '<td>'+(entry.notes === null ? "" : entry.notes)+'</td>' +
                '</tr>';
            requestTableBody.innerHTML += writeHtml;
        }));


    }

    var newRequestModalButton = document.querySelector('#newRequestButton');
    var newRequestModalEl = document.querySelector('#newRequestModal');
    var newRequestModal = new bootstrap.Modal(newRequestModalEl);

    newRequestModalButton.addEventListener('click', function () {
        newRequestModal.show();
    });

    var updateTable = function(sortBy = null){
        $.ajax({
            url: "{{ route('getRequests') }}",
            type: "GET",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);

                requestHistory = data.requestHistory;
                if(sortBy === "date"){
                    requestHistory = data.requestHistory.sort(function(a,b){
                        return new Date(b.request_date) - new Date(a.request_date);
                    });
                }else if(sortBy === "status"){
                    requestHistory = data.requestHistory.sort(function(a,b){
                        return b.status > a.status;
                    });
                }else if(sortBy === "quantity"){
                    requestHistory = data.requestHistory.sort(function(a,b){
                        return b.quantity - a.quantity;
                    });
                }

                refreshTable(requestHistory);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    newRequestModalEl.addEventListener('hidden.bs.modal', function(){
       updateTable();
    });

    var submitFormRequest = document.querySelector('#submitFormRequest');
    var requestForm = document.querySelector('#newRequestForm');

    submitFormRequest.addEventListener('click', function (e) {

        var requestFormData = new FormData(requestForm);

        e.preventDefault();
        if($("#newRequestForm").valid()){
            $.ajax({
                url: "{{ route('addRequest') }}",
                type: "POST",
                data: requestFormData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    newRequestModal.hide();
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });

</script>

</body>
</html>
