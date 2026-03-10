<!-- Price Include/Exclude Modal -->
<div class="modal fade" id="priceIncludeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="priceItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <form id="priceIncludeForm">

                @csrf
                <input type="hidden" name="tour_package_id" id="tour_package_id_for_price_includes" value="1">
                <input type="hidden" name="price_include_id" id="price_include_id">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="priceItemModalLabel">
                        <i class="fas fa-money-bill me-2"></i> Manage / Package Includes
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body px-4 py-3">
                    <div class="mb-3">
                        <label for="price_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="price_title" name="title"
                            placeholder="e.g. Hotel Stay" required>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="price_description" class="form-label">Description</label>
                        <textarea class="form-control" id="price_description" name="description" rows="3" placeholder="Details..."></textarea>
                    </div> --}}

                    <div class="mb-3">
                        <label for="is_included" class="form-label">Type</label>
                        <select class="form-select" id="is_included" name="is_included" required>
                            <option value="1">Included</option>
                            <option value="0">Excluded</option>
                        </select>
                    </div>

                    <input type="hidden" id="editingIndex">

                </div>

                <div class="modal-footer px-4 pb-3">
                    <button type="submit" class="btn btn-info w-100">
                        <i class="fas fa-save me-1"></i> Save Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
