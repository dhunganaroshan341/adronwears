<!-- Price Includes Table Modal -->
<div class="modal fade" id="priceIncludeTableModal" tabindex="-1" aria-labelledby="priceIncludesTableModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="priceIncludesTableModalLabel">Price Includes</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center"
                        id="price-include-data-show">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                {{-- <th>Price</th> --}}
                                <th>Included?</th>
                                {{-- <th>Description</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- DataTables will populate rows --}}
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
