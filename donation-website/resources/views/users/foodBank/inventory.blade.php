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
    <!-- <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset("css/theme.css") }}" rel="stylesheet" type="text/css">
{{--    Scripts--}}
    <x-ajax/>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>



</head>
<body>

{{--Navbar Component--}}

<!-- {{--{{ $schedules }}--}} -->

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
                    <a class="nav-link" aria-current="page" href="{{route('showinventory')}}">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('showschedule')}}">Schedule</a>
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
         <span class="display-6"> {{ Auth::user()->name }}</span>
    </div>
</div>

<!-- <div class="container justify-content-around" id="dashboardInformation"> -->
    <div class="row justify-content-around">
        

        <div class="col-md-5 m-1 borderShadow " id="scheduleInformation">
            <span class="lead">Inventory</span>
            <!-- Example single danger button -->
            
           <!-- Example single danger button -->
           
            <!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu">
    <li><button class="dropdown-item" onclick=sortbyexpirationdate()> Sort by Expiration Date </li>
    <li><button class="dropdown-item" onclick=sortbycategory()> Sort by Category </li>
    <li><button class="dropdown-item" onclick=sortbyquantity()> Sort by Quantity </li>    
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>


            
            <div class="container-fluid my-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Food Name</th>
                        <th scope="col">Food category</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">expiration Date</th>
                    </tr>
                    </thead>
                    <tbody id="inventory">

                    @foreach($data as $item)
                        <tr>
                            <td>{{ $item->food_name }}</td>
                            <td>{{ $item->food_category }}</td>
                            <td>{{ $item->quantity }} {{ $item->unit}}</td>
                            <td>{{ $item->expiration_date }}</td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
<!-- </div> -->

<script>

    
function sortbyexpirationdate() {
    var inventory = document.getElementById('inventory');
    inventory.innerHTML = '';
    
    $.ajax({
        url: "{{ route('getfooddata') }}",
        type: 'GET',
        dataType: 'json',
        
        success: function(response) {
            console.log(response);
            var data = response;
            
            // Sort the data by expiration date
            data.sort(function(a, b) {
                var dateA = new Date(a.expiration_date);
                var dateB = new Date(b.expiration_date);
                return dateA - dateB;
            });

            for (var i = 0; i < data.length; i++) {
                var remainingItems = "<tr><th scope='row'>" + data[i].food_name + "</th><td>" + data[i].category + "</td><td>" + data[i].quantity + data[i].unit "</td><td>" + data[i].expiration_date + "</td></tr>";
                $('#inventory').append(remainingItems);
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


    var refreshData = function() {

        var inventory = document.getElementById('inventory');

        $.ajax({
            url:'{{ route('refreshData') }}',
            type:'GET',
            dataType:'json',
            success: function (response) {
                // console.log(response);
                inventory.innerHTML = '';


                // for(i = 0; i < response.schedules.length; i++){
                //     var remainingitems = "<tr><th scope='row'>" + response.data[i].food_name + "</th><td>" + response.data[i].category + "</td><td>" + response.data[i].quantity +"</td><td>" + response.data[i].expiration_date + "</td></tr>";

                //     $('#inventory').append(sremainingitems);
                // }
            },
            error: function (response) {
                console.log(response);
            }

            });
    }



</script>


</body>
</html>
