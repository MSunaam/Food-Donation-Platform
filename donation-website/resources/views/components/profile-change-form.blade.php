<form action="{{ 'update_profile' }}" method="post" id="updateProfileForm" autocomplete="off" class="needs-validation" novalidate>
    @csrf
    <div id="updateProfileQuestions">

        <div class="row justify-content-center">
            <label for="name" class="col-md-3 col-form-label mt-3">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control mt-3" id="name" name="name" value="{{ Auth::user()->name }}" required>
                <label for="name" class="error fail-alert"></label>
            </div>
        </div>

        <div class="row justify-content-center">
            <label for="old_password" class="col-md-3 col-form-label mt-3">Old Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control mt-3" id="old_password" name="old_password" placeholder="" required>
                <label for="old_password" class="error fail-alert"></label>
            </div>
        </div>

        <div class="row justify-content-center">
            <label for="password" class="col-md-3 col-form-label mt-3">Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control mt-3" id="password" name="password" placeholder="">
                <label for="password" class="error fail-alert"></label>
            </div>
        </div>

        <div class="row justify-content-center">
            <label for="confirm_password" class="col-md-3 col-form-label mt-3">Confirm Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control mt-3" id="confirm_password" name="confirm_password" placeholder="">
                <label for="confirm_password" class="error fail-alert"></label>
            </div>
        </div>

        <div class="row justify-content-center">
            <label for="address" class="col-md-3 col-form-label mt-3">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control mt-3" id="address" name="address" value="{{ Auth::user()->address }}" required>
                <label for="address" class="error fail-alert"></label>
            </div>
        </div>

        <div class="row justify-content-center">
            <label for="city" class="col-md-3 col-form-label mt-3">City</label>
            <div class="col-sm-6">
                <input type="text" class="form-control mt-3" id="city" name="city" value="{{ Auth::user()->city }}" required>
                <label for="city" class="error fail-alert"></label>
            </div>
        </div>

        <div class="row justify-content-center">
            <label for="phone_number" class="col-md-3 col-form-label mt-3">Phone Number</label>
            <div class="col-sm-6">
                <input type="number" class="form-control mt-3" id="phone_number" name="phone_number" value="{{ Auth::user()->phone_number }}" required>
                <label for="phone_number" class="error fail-alert"></label>
            </div>
        </div>

        <div id="errorDiv" class="d-none text-center mt-3">

        </div>

        <div>
            <button class="btn btn-gunmetal mt-4" id="updateProfileFormButton">Change</button>
        </div>
        <div class="mx-2 mt-3 align-text-bottom d-none alert alert-success" id="updateAlert">Successfully Updated</div>

    </div>
</form>
