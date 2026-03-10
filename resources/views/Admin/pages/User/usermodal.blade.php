<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
 aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form id="formId" class="form">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="validationErrors" class="alert alert-danger d-none"></p>
                <div class="row">
                    <span class="mt-2 mb-2"><span class="text-danger">Note:</span> (<span class="text-danger">*</span>) symbol represent that the field is required</span>
                    <div class="col-md-6">
                        @csrf
                        <label for="" class="form-label">Full Name<span class="text-danger">*</span></label>
                        <input type="text" name="full_name" id="full_name" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Position<span class="text-danger">*</span></label>
                        <input type="text" name="position" id="position" class="form-control" placeholder=""
                            aria-describedby="helpId" />
                    </div>

                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder=""
                            aria-describedby="helpId" />
                    </div>
                    <div class="col-md-6 mt-2 mb-2 labelPassword">
                        <label for="" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                        Show Password <input type="checkbox" name="" id="checkbox">
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Phone Number<span class="text-danger">*</span></label>
                        <input type="number" name="phonenumber" id="phonenumber" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Email Link</label>
                        <input type="url" name="email_link" id="email_link" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Facebook Link</label>
                        <input type="url" name="facebook_link" id="facebook_link" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Instagram Link</label>
                        <input type="url" name="instagram_link" id="instagram_link" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Twitter Link</label>
                        <input type="url" name="twitter_link" id="twitter_link" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                    </div>
                    <div class="col-md-6 mt-2 mb-2">
                        <label for="" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control"
                            placeholder="" aria-describedby="helpId" />
                        <div id="userImage"> </div>
                    </div>

                    <div class="col-md-12 mt-4 mb-2">
                        <label for="" class="form-label">Notes</label>
                        <textarea class="form-control summernote" id="notes_user" name="notes" rows="4"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update
                    User</button>
            </div>
        </form>
    </div>
</div>
</div>
