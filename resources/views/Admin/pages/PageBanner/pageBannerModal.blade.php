<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow-lg rounded-4">
            <form id="formId" class="form" enctype="multipart/form-data">
                @csrf

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="formModalLabel">Update Page Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>

                    <div class="alert alert-info small">
                        <strong class="text-danger">*</strong> indicates required fields
                    </div>

                    <div class="row g-4">
                        <!-- Page and Section -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Page</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light" id="page"></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Section</label>
                            <p class="form-control-plaintext border rounded px-3 py-2 bg-light" id="section"></p>
                        </div>

                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter title">
                        </div>

                        <!-- Sub Heading -->
                        <div class="col-md-6">
                            <label for="sub_heading" class="form-label">Sub Heading</label>
                            <input type="text" name="sub_heading" id="sub_heading" class="form-control"
                                placeholder="Enter sub heading">
                        </div>

                        <!-- Image -->
                        <div class="col-md-6">
                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control">
                            <div class="mt-2" id="bannerImage"></div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <label for="description" class="form-label">Description <span
                                    class="text-danger">*</span></label>
                            <textarea name="description" id="description" class="form-control summernote" rows="4"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top-0 mt-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update Page
                        Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
