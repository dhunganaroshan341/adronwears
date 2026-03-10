<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="homeSlideTitle">Add Service</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span class="text-danger">*</span>) symbol represent that the field is required</span>
                        <div class="col-md-6">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <label for="" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Short Description<span class="text-danger">*</span></label>
                            <input type="text" name="short_desc" id="short_desc" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                        </div>
                         <div class="col-md-6">
                            <label for="" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            <div id="testimonialImage"> </div>
                        </div>

                        <div class="col-md-12 mt-4 mb-2">
                            <label for="" class="form-label">Description<span class="text-danger">*</span></label>
                            <textarea class="form-control summernote" id="description" name="description" rows="4"></textarea>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update
                        Service</button>
                </div>
            </form>
        </div>
    </div>
</div>
