<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="homeSlideTitle">Add HomeSlide</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span
                                class="text-danger">*</span>) symbol represent that the field is required</span>
                        <div class="col-md-6">
                            @csrf
                            <label for="" class="form-label">Title<span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title_home" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Image<span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                            <div id="homeSlideImage"> </div>
                        </div>
                        <div class="col-md-12 mt-4 mb-2">
                            <label for="" class="form-label">Short Description</label>
                            <textarea class="form-control summernote" id="homeSliderDescription" name="shortdesc" rows="4"></textarea>
                        </div>

                        <div class="col-md-6">

                            <label for="link_text" class="form-label">Link Text<span class="text-danger"></span></label>
                            <input type="text" name="link_text" id="link_text" class="form-control"
                                placeholder="About Us" aria-describedby="helpId" />
                        </div>
                        <div class="col-md-6">

                            <label for="link_url" class="form-label">Link Url<span class="text-danger"></span></label>
                            <input type="text" name="link_url" id="link_url" class="form-control"
                                placeholder="Eg.https://ommundumtreks.com/about-us/" aria-describedby="helpId" />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update
                        HomeSlide</button>
                </div>
            </form>
        </div>
    </div>
</div>
