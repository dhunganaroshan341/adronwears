<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <form id="achievementForm" class="form needs-validation" novalidate>
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h1 class="modal-title fs-5 mb-0">Add Achievement</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>

                    <div class="row g-3">
                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label fw-semibold">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter achievement title" required>
                            <div class="invalid-feedback">Please enter a title.</div>
                        </div>

                        <!-- Icon Class -->
                        <div class="col-md-4">
                            <label for="icon_class" class="form-label fw-semibold">
                                Icon Class <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="icon_class" id="icon_class" class="form-control"
                                placeholder="e.g., fas fa-trophy" required>
                            <div class="invalid-feedback">Please enter an icon class.</div>
                        </div>

                        <!-- Count -->
                        <div class="col-md-2">
                            <label for="count" class="form-label fw-semibold">
                                Count <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="count" id="count" class="form-control" placeholder="0"
                                required min="0">
                            <div class="invalid-feedback">Please enter a valid number.</div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn">Submit</button>
                    <button type="submit" class="btn btn-warning updateBtn ">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
