<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory-MealShare</title>
    <x-favicon/>

{{--    CSS--}}
    <x-bootstrap-css/>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/inventory.css') }}">
{{--    Script--}}
    <x-ajax/>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



</head>
<body>

{{--Navbar Component--}}

{{--@if(Auth::user()->user_type != 'food_bank')--}}
{{--    <script> window.location.href = "{{ route('home') }}" </script>--}}
{{--@endif--}}

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{ route('home')  }}">
            <img src="{{ asset('images/food-bank.png') }}" alt="mealShare" width="30" height="24" class="d-inline-block align-text-top">
            MealShare
        </a>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('donationHistory') }}">Donation</a>
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
         <span class="display-6" id="inventoryHeading">Inventory</span>
    </div>
</div>

<div class="btn-group d-inline-block mt-3" id="sortInventoryButton">
    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Sort By
    </button>
    <ul class="dropdown-menu">
        <li><button class="dropdown-item" id="sortByExpirationDate">Sort by Expiration Date </li>
        <li><button class="dropdown-item" id="sortByCategory"> Sort by Category </li>
        <li><button class="dropdown-item" id="sortByQuantity"> Sort by Quantity </li>
    </ul>
</div>

<div class="container justify-content-around mainDiv">
    <div class="row justify-content-around">
        <div class="container-fluid my-3">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Food Name</th>
                    <th scope="col">Food category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Expiration Date</th>
                </tr>
                </thead>
                <tbody id="inventoryTable">

                @if($data->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">No data available</td>
                    </tr>
                @else
                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->food_name }}</td>
                            <td>{{ $item->food_category }}</td>
                            <td>{{ $item->quantity }} {{ $item->unit}}</td>
                            <td>{{ $item->expiration_date }}</td>

                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>

        </div>
    </div>

<script>

    function formatDate(str) {
        var year = str.slice(0,4);
        var month = str.slice(5,7);
        var day = str.slice(8,10);
        return day + '-' + month + '-' + year;
    }

    var inventoryTable = document.getElementById('inventoryTable');

    var sortByCategoryButton = document.getElementById('sortByCategory');
    var sortByExpirationDateButton = document.getElementById('sortByExpirationDate');
    var sortByQuantityButton = document.getElementById('sortByQuantity');

    sortByCategoryButton.addEventListener('click', function(){
        refreshData('food_category');
    });

    sortByExpirationDateButton.addEventListener('click', function(){
        refreshData('expiration_date');
    });

    sortByQuantityButton.addEventListener('click', function(){
        refreshData('quantity');
    });

    function refreshData(sortBy = null){
        inventoryTable.innerHTML = "";
        $.ajax({
            url: "{{ route('showInventory') }}",
            type: 'GET',
            success: function(response) {
                console.log(response);
                arrData = response.data;

                if(sortBy === "date"){
                    arrData = response.data.sort(function(a,b){
                        return new Date(b.expiration_date) - new Date(a.expiration_date);
                    });
                }else if(sortBy === "status"){
                    arrData = response.data.sort(function(a,b){
                        return b.status > a.status;
                    });
                }else if(sortBy === "quantity"){
                    arrData = response.data.sort(function(a,b){
                        return b.quantity - a.quantity;
                    });
                }

                for (var i = 0; i < arrData.length; i++) {
                    var remainingItems = "<tr><td>" + arrData[i].food_name + "</td><td>" + arrData[i].food_category + "</td><td>" + arrData[i].quantity+ " " + arrData[i].unit + "</td><td>" + formatDate(arrData[i].expiration_date) + "</td></tr>";
                    inventoryTable.innerHTML += remainingItems;
                }
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>

</body>
</html>
