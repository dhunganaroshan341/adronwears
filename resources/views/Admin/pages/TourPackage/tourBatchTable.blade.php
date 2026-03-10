<!-- Tour Batch Table Modal -->
<div class="modal fade" id="tourBatchTableModal" tabindex="-1" aria-labelledby="tourBatchTableModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="tourBatchTableModalLabel">Tour Batches</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center"
                        id="tour-batch-data-show">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <!-- Remove this title header -->
                                <!-- <th>Title</th> -->
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Max People</th>
                                <th>Available Seats</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody>
                            {{-- DataTables will handle rows --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
