<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="formModalLabel">Add Call To Action</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4">
                            <span class="text-danger">Note:</span>
                            (<span class="text-danger">*</span>) symbol represents required fields
                        </span>

                        @csrf

                        <div class="col-md-6">
                            <label for="title" class="form-label">Title<span class="text-danger"></span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter CTA Title" />
                        </div>
                        <!-- Sub Heading -->
                        <div class="col-md-6">
                            <label for="sub_heading" class="form-label">Sub Heading</label>
                            <input type="text" name="sub_heading" id="sub_heading" class="form-control"
                                placeholder="Enter sub heading">
                        </div>

                        <div class="col-md-6">
                            <label for="button_text" class="form-label">Button Text<span
                                    class="text-danger"></span></label>
                            <input type="text" name="button_text" id="button_text" class="form-control"
                                placeholder="e.g. Learn More" />
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="button_url" class="form-label">Button URL<span
                                    class="text-danger"></span></label>
                            <input type="url" name="button_url" id="button_url" class="form-control"
                                placeholder="https://example.com" />
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" />
                            <div id="callToActionImage" class="mt-2"> </div>
                        </div>
                        <div class="col-md-6">
                            <label for="iframe" class="form-label">Video Iframe Code<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="iframe" id="iframe" class="form-control"
                                placeholder="youtube iframe" />
                        </div>


                        <div class="col-md-12 mt-4 mb-2">
                            <label for="description" class="form-label">Description<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="description" name="description" rows="4"
                                placeholder="Describe the CTA..."></textarea>
                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update Call To
                        Action</button>
                </div>
            </form>
        </div>
    </div>
</div>
