<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="formNotice">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="noticeTitle">Add Notice</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span
                                class="text-danger">*</span>) symbol represent that the field is required</span>

                        <div class="col-md-6">
                            <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            <small id="title-error" class="text-danger errorMessage"></small>
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            <small id="image-error" class="text-danger errorMessage"></small>
                            <div id="noticeImage"></div>
                        </div>

                        <!-- New URL field added here -->
                        <div class="col-md-12 mt-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="url" name="url" id="url" class="form-control"
                                placeholder="https://example.com" aria-describedby="urlHelp" />
                            <small id="url-error" class="text-danger errorMessage"></small>
                        </div>

                        <div class="col-md-12 mt-4 mb-2">
                            <label for="description" class="form-label">Short Description</label>
                            <textarea class="form-control description" id="description" name="description" rows="4"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitNoticeBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateNoticeBtn" data-action="edit">Update
                        HomeSlide</button>
                </div>
            </form>
        </div>
    </div>
</div>
