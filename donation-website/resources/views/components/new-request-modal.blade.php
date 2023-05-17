<!-- Modal -->
<div class="modal fade" id="newRequestModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('addRequest') }}" method="post" id="newRequestForm" autocomplete="on" class="needs-validation" novalidate>
                    @csrf
                    <div>

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
                            <label for="quantity" class="col-md-3 col-form-label mt-3">Quantity</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control mt-3" id="quantity" name="quantity" placeholder="" required>
                                <label for="quantity" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="unit" class="col-md-3 col-form-label mt-3">Unit</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="unit" name="unit" placeholder="" required>
                                <label for="unit" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="status" class="col-md-3 col-form-label mt-3">Status</label>
                            <div class="col-sm-6">
                                <select class="form-select mt-3" aria-label="Default select example" name="status">
                                    <option selected value="">Status</option>
                                    <option value="Open">Open</option>
                                </select>
                                <label for="status" class="error fail-alert"></label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <label for="notes" class="col-md-3 col-form-label mt-3">Note</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control mt-3" id="note" name="notes" placeholder="Note" required>
                                <label for="notes" class="error fail-alert"></label>
                            </div>
                        </div>

                    </div>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gunmetal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-orange" id="submitFormRequest">Add Request</button>
            </div>
        </div>
    </div>
</div>
