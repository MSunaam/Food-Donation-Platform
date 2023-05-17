<!-- Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('delete_account') }}" method="post" id="deleteAccountForm" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div>
                        <div class="row justify-content-center">
                            <p class="lead text-center">Are you sure you want to delete your account?</p>
                        </div>

                        <div class="row justify-content-center">
                            <label for="password" class="col-md-3 col-form-label mt-3">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control mt-3" id="password" name="password" placeholder="" required>
                                <label for="password" class="error fail-alert"></label>
                            </div>
                        </div>

                    </div>
                </form>

                <div class="text-center d-none" id="deleteAccountError" role="alert">
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-red" id="deleteAccountButton">Delete Account</button>
            </div>
        </div>
    </div>
</div>
