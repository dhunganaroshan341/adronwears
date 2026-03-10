<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="albumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="formId" class="form" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="albumModalLabel">Add / Update Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <p id="loading-paragraph"></p> <!-- Moved inside the modal-body -->

                    <p id="validationErrors" class="alert alert-danger d-none"></p>

                    <span class="mb-3 d-block">
                        <strong class="text-danger">Note:</strong>
                        Fields marked with (<span class="text-danger">*</span>) are required.
                    </span>

                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="Enter title" required>
                    </div>

                    <div class="col-md-12 mb-4">
                        <label for="" class="form-label">Gallery Images<span
                                class="text-danger">*</span></label>
                        <input type="file" name="media_path[]" id="galleryMedia" class="form-control" multiple
                            placeholder="" aria-describedby="helpId" />
                        <span class="text-danger infoPostImageText"></span>
                    </div>

                    <!-- Showing all the images of this Gallery media -->
                    <div class="galleryMediaWrapper" style="max-height: 400px; overflow-y: auto;">
                        <div class="row galleryMediaData">
                            <!-- Images will be appended here -->
                        </div>
                    </div>

                    <div class="mb-3">
                        <img id="thumbnailImage" src="" alt="thumbnail">
                    </div>

                    <input type="hidden" name="type" id = "type" value = "image">





                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="create">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Image Crousal --}}
<div class="modal fade" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="postImageTitle">Image List</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner fetch-post-image-data">
                            <!-- Carousel images will be added here -->
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .galleryMediaWrapper {
            max-height: 400px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #fafafa;
        }

        .galleryMediaData {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .galleryMediaData .gallery-item {
            width: 100px;
            height: 100px;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
        }

        .galleryMediaData .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush
