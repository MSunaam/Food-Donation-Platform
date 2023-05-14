<!-- Modal -->
<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Scheduling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('add_scheduling') }}" method="post" id="addScheduling" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div id="questionssc">

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


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-orange" id="submitFormsc">Add Items</button>
            </div>
        </div>
    </div>
</div>
