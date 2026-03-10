<!-- Upload Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-upload me-2"></i> Upload Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Toggle buttons -->
                <div class="mb-3 text-center">
                    <button id="btnImage" class="btn btn-outline-primary active me-2" type="button">Upload
                        Image</button>
                    <button id="btnVideo" class="btn btn-outline-secondary" type="button">Add YouTube Video</button>
                </div>

                <!-- Dropzone for Images -->
                <form class="dropzone" id="mydropzone" enctype="multipart/form-data" style="min-height: 200px;">
                    @csrf
                    <input type="hidden" name="tour_package_id" id="tour_package_id">
                </form>

                <!-- YouTube iframe input -->
                <div id="videoInputWrapper" class="d-none">
                    <label for="youtubeIframe" class="form-label">YouTube Video Iframe or URL</label>
                    <textarea id="youtubeIframe" class="form-control" rows="3"
                        placeholder="Paste the YouTube embed iframe code or video URL here"></textarea>
                    <small class="form-text text-muted">Example iframe: &lt;iframe
                        src="https://www.youtube.com/embed/VIDEO_ID" ...&gt;&lt;/iframe&gt; or just the URL.</small>
                </div>

            </div>

            <div class="modal-footer">
                <button id="uploadSubmitBtn" type="button" class="btn btn-success">Upload</button>
                <button id="closeBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
