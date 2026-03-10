<div class="modal fade" id="itineraryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="itineraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg">
            <form class="itineraryForm">
                @csrf

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="itineraryModalLabel">
                        <i class="fas fa-route me-2"></i> Add / Edit Itinerary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-4 justify-content-center text-center">


                        <!-- Day Number -->
                        <div class="col-md-4">
                            <label for="day_number" class="form-label">Days</label>
                            <input type="number" class="form-control" id="day_number" name="day_number" min="1"
                                max="30" placeholder="e.g. 1" required>
                        </div>

                        <!-- Order -->
                        <div class="col-md-4">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" class="form-control" id="order" name="order" min="1"
                                max="100" placeholder="e.g. 1" required>
                        </div>

                        <!-- Title -->
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title (optional)</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="e.g. Drive to Pokhara">
                        </div>

                        <!-- Description with Summernote -->
                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control summernote" id="description" name="description" style="min-height: 250px;"
                                placeholder="Write a short description for the day..." required></textarea>
                        </div>

                        <!-- Hidden -->
                        <input type="hidden" id="tour_package_id" name="tour_package_id">
                    </div>
                </div>

                <div class="modal-footer px-4 pb-3">
                    <button id="submitItineraryBtn" type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-1"></i> Save Itinerary
                    </button>
                    <button id="updateItineraryBtn" hidden type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Update Itinerary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
