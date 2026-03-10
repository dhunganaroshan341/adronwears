<!-- Itinerary Modal -->
<div class="modal fade" id="itineraryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="itineraryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg">
            <form class="itineraryForm" id="ItineraryForm">
                @csrf

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="itineraryModalLabel">
                        <i class="fas fa-route me-2"></i> Add Itinerary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row g-4">

                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title <small>(*)</small></label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="e.g. Day 1 - Kathmandu Arrival">
                        </div>

                        <!-- Day Number -->
                        <div class="col-md-6">
                            <label for="day_number" class="form-label"> Number of Days</label>
                            <input type="number" class="form-control" id="day_number" name="day_number" min="1"
                                max="365" placeholder="e.g. 1" value="1" readonly>

                        </div>

                        <!-- Order -->
                        <div class="col-md-6">
                            <label for="order" class="form-label">Display Order</label>
                            <input type="number" class="form-control" id="order" name="order"
                                placeholder="Auto-fetched">
                        </div>

                        <!-- Status -->
                        <!-- Status -->
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <label class="form-label d-block mb-2">Status</label>
                            <div class="d-flex gap-4">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="status" id="statusActive"
                                        value="Active" checked>
                                    <label class="form-check-label mb-0" for="statusActive">Active</label>
                                </div>
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="radio" name="status" id="statusInactive"
                                        value="Inactive">
                                    <label class="form-check-label mb-0" for="statusInactive">Inactive</label>
                                </div>
                            </div>
                        </div>



                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description <small>(min. 5
                                    characters)</small></label>
                            <textarea class="form-control summernote" id="description" name="description" rows="5"
                                placeholder="Describe the day's itinerary..."></textarea>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="tour_package_id" id="tour_package_id">
                        <input type="hidden" name="itinerary_id" id="itinerary_id"> <!-- For editing -->
                    </div>
                </div>

                <div class="modal-footer px-4 pb-3">
                    <button id="submitItineraryBtn" type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                    <button id="updateItineraryBtn" type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sync-alt me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
