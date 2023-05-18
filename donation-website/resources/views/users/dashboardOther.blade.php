<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard-MealShare</title>
    <x-favicon/>
    {{--    Styles--}}
    <x-bootstrap-css/>
    <link rel="stylesheet" href="{{ asset('css/dashboardOther.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    {{--    Scripts--}}
    <x-lottie/>
    <x-ajax/>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</head>
<body>

@if(Auth::user())
@else
    <script>window.location.href = {{ route('login') }};</script>
@endif

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
                    <a class="nav-link active" href="">Dashboard</a>
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
    <div class="text-center">
        <span class="display-6">Welcome, {{ Auth::user()->name }}</span>
    </div>
</div>

<div class="container justify-content-around mainDiv">
    <div class="row justify-content-between">
        <div class="col text-center borderShadow">
            <div class="mb-3">
                <span class="lead">Recent Requests</span>
            </div>
            <div class="btn-group d-inline-block mt-3" id="sortInventoryButton">
                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu">
                    <li><button class="dropdown-item" id="sortByRequestDate">Sort by Request Date </li>
                    <li><button class="dropdown-item" id="sortByCategory"> Sort by Category </li>
                    <li><button class="dropdown-item" id="sortByQuantity"> Sort by Quantity </li>
                    <li><button class="dropdown-item" id="sortByStatus"> Sort by Status </li>
                </ul>
            </div>
            <table class="table" id="recentRequestTable">
                <thead>
                    <tr>
                        <th scope="col">Request Id</th>
                        <th scope="col">Requester Name</th>
                        <th scope="col">Food Category</th>
                        <th scope="col">Food Quantity</th>
                        <th scope="col">Request Status</th>
                        <th scope="col">Request Date</th>
                        <th scope="col">Donate</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Donation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('newDonation') }}" method="post" id="add_donation_form" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div id="donation_questions">

                        <div class="row justify-content-center">
                            <label for="food_name" class="col-md-3 col-form-label mt-3">Food Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="food_name" name="food_name" placeholder="" required>
                                <label for="food_name" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="request_id" class="col-md-3 col-form-label mt-3">Request Id</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control mt-3" id="request_id" name="request_id" placeholder="" disabled>
                                <label for="scheduled_pickup_time" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="quantity" class="col-md-3 col-form-label mt-3">Quantity</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control mt-3" id="quantity" name="quantity" placeholder="" required>
                                <label for="scheduled_pickup_time" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="scheduled_pickup_time" class="col-md-3 col-form-label mt-3">Scheduled Pickup Time</label>
                            <div class="col-sm-6">
                                <input type="datetime-local" class="form-control mt-3" id="scheduled_pickup_time" name="scheduled_pickup_time" placeholder="" required>
                                <label for="scheduled_pickup_time" class="error fail-alert"></label>
                            </div>
                        </div>

                    </div>
                </form>

                <div id="donationError" class="alert d-none text-center"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-orange" id="addDonation">Add Donation</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('#sortByCategory').click(()=>getRequests('category'));
    $('#sortByQuantity').click(()=>getRequests('quantity'));
    $('#sortByRequestDate').click(()=>getRequests('request_date'));
    $('#sortByStatus').click(()=>getRequests('status'));

    addDonationButton = document.getElementById('addDonation');
    addDonationButton.addEventListener('click', function (e) {
        e.preventDefault();
        var form = document.getElementById('add_donation_form');
        var formData = new FormData(form);
        var donor_id = {{ Auth::user()->id }};
        formData.append('donor_id', donor_id);
        var request_id = document.getElementById('request_id').value;
        formData.append('request_id', request_id);

        $.ajax({
            url: "{{ route('newDonation') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data);
                donationsModal.hide();
            },
            error: function(data){
                var errorDiv = document.getElementById('donationError');
                errorDiv.classList.remove('d-none');
                errorDiv.innerHTML = data.responseJSON.message;

            }
        });

    })


    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function formatDate(str) {
        var year = str.slice(0,4);
        var month = str.slice(5,7);
        var day = str.slice(8,10);
        return day + '-' + month + '-' + year;
    }

    var donationsModalEl = document.getElementById('modal2');
    var donationsModal = new bootstrap.Modal(donationsModalEl);

    donationsModalEl.addEventListener('hide.bs.modal', function (event) {
        getRequests();
        errorDiv = document.getElementById('donationError');
        errorDiv.classList.add('d-none');
        errorDiv.innerHTML = "";
    });


    function donate(id){
        donationsModal.show();
        document.getElementById('request_id').value = id;
    }

    var requestsTablebody = document.getElementById('tableBody');

    function getRequests(sortBy = null){
        $.ajax({
            url: "{{ route('recentRequests') }}",
            type: "GET",
            success: function(data) {
                requestsTablebody.innerHTML = "";
                var requests = data.requests;

                if(sortBy === 'quantity'){
                    requests.sort(function(a, b) {
                        return b.quantity - a.quantity;
                    });
                }else if(sortBy === 'date') {
                    requests.sort(function (a, b) {
                        return new Date(b.request_date) - new Date(a.request_date);
                    });
                }else if(sortBy === 'status') {
                    requests.sort(function(a, b) {
                        var statusA = a.status.toUpperCase(); // ignore upper and lowercase
                        var statusB = b.status.toUpperCase(); // ignore upper and lowercase
                        if (statusA < statusB) {
                            return -1;
                        }
                        if (statusA > statusB) {
                            return 1;
                        }
                        return 0;
                    });
                }else if(sortBy === 'category') {
                    requests.sort(function(a, b) {
                        var categoryA = a.food_category.toUpperCase(); // ignore upper and lowercase
                        var categoryB = b.food_category.toUpperCase(); // ignore upper and lowercase
                        if (categoryA < categoryB) {
                            return -1;
                        }
                        if (categoryA > categoryB) {
                            return 1;
                        }
                        return 0;
                    });
                }

                console.log(requests);

                if(requests.length === 0) {
                    requestsTablebody.innerHTML = "<tr><td colspan='7' class='text-center'>No Requests Found</td></tr>";
                }
                requests.forEach(function(request){
                    var row = "<tr><td>"+request.id+"</td><td>"+request.name+"</td><td>"+request.food_category+"</td><td>"+request.quantity+"</td><td>"+capitalizeFirstLetter(request.status)+"</td><td>"+formatDate(request.request_date)+"</td><td><button class='btn btn-secondary' onclick='donate("+request.id+")'>Donate</button></td></tr>";
                    requestsTablebody.innerHTML += row;
                });

            },
            error: function(error){
               console.log(error)
            }
        });
    }

    getRequests();

</script>


</body>
</html>
