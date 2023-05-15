<!-- Modal -->
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Mark Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('mark_schedule') }}" method="post" id="mark_schedule_form" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div id="mark_schedule_questions">

                        <div class="row justify-content-center">
                            <label for="donation_id" class="col-md-3 col-form-label mt-3">Donation Id</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control mt-3" id="donation_id" name="donation_id" placeholder="Donation Id" required>
                                <label for="donation_id" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="status" class="col-md-3 col-form-label mt-3">Status</label>
                            <div class="col-sm-6">
                                <select class="form-select mt-3" aria-label="Default select example" name="status">
                                    <option selected value="">Status</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="scheduled">Scheduled</option>
                                </select>
                                <label for="status" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="actual_pickup_time" class="col-md-3 col-form-label mt-3">Actual Pickup Time</label>
                            <div class="col-sm-6">
                                <input type="datetime-local" class="form-control mt-3" id="actual_pickup_time" name="actual_pickup_time" placeholder="" required>
                                <label for="actual_pickup_time" class="error fail-alert"></label>
                            </div>
                        </div>

                    </div>
                </form>

                <div id="markScheduleError" class="alert d-none text-center"></div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-orange" id="changeStatus">Schedule</button>
            </div>
        </div>
    </div>
</div>
