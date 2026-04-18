<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="categoryTitle">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span
                                class="text-danger">*</span>) symbol represent that the field is required</span>
                        <div class="col-md-12">
                            @csrf
                            <label for="" class="form-label">Name<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="categorytitleData" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                        </div>

                        <div class="col-md-12 mt-3">
                            <label for="" class="form-label">Status<span class="text-danger">*</span></label>
                            <select class="form-select" name="status" id="categoryStatusData">
                                <option value="" selected disabled>--Select Status--</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>
                        <!-- parent category -->
                        <div class="col-md-12 mt-3">
                            <label for="" class="form-label">Parent Category</label>
                            <select class="form-select" name="parent_id" id="parentCategoryData">
                                <option value="" selected>--No Parent--</option>
                                @foreach ($parentCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-success submitBtn"
                                data-action="">Submit</button>
                            <button type="submit" class="btn btn-outline-success updateBtn" data-action="edit">Update
                                Category</button>
                        </div>
            </form>
        </div>
    </div>
</div>