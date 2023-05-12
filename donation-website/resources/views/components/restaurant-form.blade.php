<div id="question2">
    <p class="display-5" id="heading">Great! Let's get you set up</p>
    <div class="row justify-content-center">
        <label for="name" class="col-md-3 col-form-label mt-3">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control mt-3" id="name" name="name" placeholder="" required>
            <label for="name" class="error fail-alert"></label>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <label for="email" class="col-md-3 col-form-label mt-3">Email</label>
        <div class="col-sm-6">
            <input type="email" class="form-control mt-3" id="email" name="email" placeholder="yourEmail@meow.com" required>
            <label for="email" class="error fail-alert"></label>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <label for="password" class="col-md-3 col-form-label mt-3">Password</label>
        <div class="col-sm-6">
            <input type="password" class="form-control mt-3" id="password" name="password" placeholder="" required>
            <label for="password" class="error fail-alert"></label>
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <label for="confirm_password" class="col-md-3 col-form-label mt-3">Confirm Password</label>
        <div class="col-sm-6">
            <input type="password" class="form-control mt-3" id="confirm_password" name="confirm_password" placeholder="" required>
            <label for="confirm_password" class="error fail-alert"></label>
            @error('confirm_password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <label for="address" class="col-md-3 col-form-label mt-3">Address</label>
        <div class="col-sm-6">
            <input type="text" class="form-control mt-3" id="address" name="address" placeholder="Address" required>
            <label for="address" class="error fail-alert"></label>
            @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center">
        <label for="phone_number" class="col-md-3 col-form-label mt-3">Phone</label>
        <div class="col-sm-6">
            <input type="text" class="form-control mt-3" id="phone" name="phone_number" placeholder="+9200000000" required>
            <label for="phone_number" class="error fail-alert"></label>
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row justify-content-end mt-3 mx-3">
            <div class="col-2">
                <button class="btn btn-green" id="submitForm">Register</button>
            </div>
    </div>

</div>
