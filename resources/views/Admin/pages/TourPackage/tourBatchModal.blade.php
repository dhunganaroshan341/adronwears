<!-- Tour Batch Form Modal -->
<div class="modal fade" id="tourBatchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="tourBatchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg">
            <form id="tourBatchForm" class="tourBatchForm">
                @csrf
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="tourBatchModalLabel">
                        <i class="fas fa-users me-2"></i> Add / Edit Tour Batch
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-4 justify-content-center text-center">

                        <!-- Start Date -->
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>

                        <!-- End Date -->
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>

                        <!-- Max People -->
                        <div class="col-md-6">
                            <label for="max_people" class="form-label">Max People</label>
                            <input type="number" class="form-control" id="max_people" name="max_people" min="1"
                                placeholder="e.g. 20" required>
                        </div>

                        <!-- Available Seats -->
                        <div class="col-md-6">
                            <label for="available_seats" class="form-label">Available Seats</label>
                            <input type="number" class="form-control" id="available_seats" name="available_seats"
                                min="0" placeholder="e.g. 15" required>
                        </div>

                        <!-- Price (optional) -->
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price (optional)</label>
                            <input type="number" class="form-control" id="price" name="price"
                                placeholder="e.g. 15000">
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="active">Active</option>
                                <option value="full">Full</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>

                        <!-- Hidden -->
                        <input type="hidden" id="tour_package_id_batch" name="tour_package_id">
                    </div>
                </div>

                <div class="modal-footer px-4 pb-3">
                    <button id="submitBatchBtn" type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Save Tour Batch
                    </button>
                    <button id="updateBatchBtn" type="submit" class="btn btn-primary w-100" style="display: none;">
                        <i class="fas fa-save me-1"></i> Update Tour Batch
                    </button>
                </div>


        </div>
        </form>
    </div>
</div>
</div>
