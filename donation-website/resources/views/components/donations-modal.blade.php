<!-- Modal -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Donation Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('add_donation') }}" method="post" id="add_donation_form" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div id="donation_questions">

                        <div class="row justify-content-center">
                            <label for="donor_id" class="col-md-3 col-form-label mt-3">Donor Id</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="donor_id" name="donor_id" placeholder="Donor Id" required>
                                <label for="donor_id" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="food_name" class="col-md-3 col-form-label mt-3">Food Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="food_name" name="food_name" placeholder="Food Name" required>
                                <label for="food_name" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="food_category" class="col-md-3 col-form-label mt-3">Category</label>
                            <div class="col-sm-6">
                                <select class="form-select mt-3" aria-label="Default select example" name="food_category">
                                    <option selected value="">Food Category</option>
                                    <option value="Produce">Produce</option>
                                    <option value="Grains">Grains</option>
                                    <option value="Dairy">Dairy</option>
                                    <option value="Meat">Meat</option>
                                    <option value="Packaged">Packaged</option>
                                    <option value="Beverages">Beverages</option>
                                    <option value="Condiments">Condiments</option>
                                    <option value="Frozen">Frozen</option>
                                </select>
                                <label for="food_category" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="status" class="col-md-3 col-form-label mt-3">Status</label>
                            <div class="col-sm-6">
                                <select class="form-select mt-3" aria-label="Default select example" name="status">
                                    <option selected value="">Status</option>
                                    <option value="Scheduled">Scheduled</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Completed">Completed</option>
                                </select>
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

                <div id="scheduleError" class="alert d-none text-center"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-orange" id="addDonation">Add Donation</button>
            </div>
        </div>
    </div>
</div>
