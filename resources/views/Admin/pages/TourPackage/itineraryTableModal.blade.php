<div class="modal fade" id="itineraryTableModalUnique" tabindex="-1" aria-labelledby="itineraryTableModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="itineraryTableModalLabel">Itinerary Items</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center"
                        id = "itinerary-data-album-show">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                {{-- <th>Day</th> --}}
                                <th>Order</th>
                                <th>Title</th>
                                <th>Days</th>
                                {{-- <th>Description</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
