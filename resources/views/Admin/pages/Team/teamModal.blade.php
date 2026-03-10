<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamModalTitle">Add Team Member</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span
                                class="text-danger">*</span>) symbol represent that the field is required</span>

                        @csrf
                        @if (isset($team))
                            <input type="hidden" id="team_id" name="id" value="{{ $team->id }}">
                        @endif


                        <div class="col-md-6">
                            <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="" />
                        </div>

                        <div class="col-md-6">
                            <label for="position" class="form-label">Position<span class="text-danger">*</span></label>
                            <input type="text" name="position" id="position" class="form-control" placeholder="" />
                        </div>

                        <div class="col-md-6">
                            <label for="order" class="form-label">Order<span class="text-danger">*</span></label>
                            <input type="number" name="order" id="order" class="form-control" placeholder="" />
                        </div>

                        <div class="col-md-6">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" />
                            <div id="teamPhoto" class="mt-2"></div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" name="facebook" id="facebook" class="form-control"
                                placeholder="https://facebook.com/username" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="text" name="twitter" id="twitter" class="form-control"
                                placeholder="https://twitter.com/username" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="text" name="linkedin" id="linkedin" class="form-control"
                                placeholder="https://linkedin.com/in/username" />
                        </div>

                        <div class="col-md-6 mt-2">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" id="instagram" class="form-control"
                                placeholder="https://instagram.com/username" />
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
