$(document).ready(function () {
    // Setup CSRF Token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ========================
    // Show Create Modal
    // ========================
    $(document).on('click', '.addTourBatchBtn', function () {
        const packageId = $(this).data('id');

        $('#tourBatchModal').modal('show');
        $('.tourBatchForm')[0].reset();
        $('#tour_package_id_batch').val(packageId);

        $('#submitBatchBtn').show();
        $('#updateBatchBtn').hide();

        $('.tourBatchForm').attr('id', 'createTourBatchForm').removeAttr('data-id');
    });

    // ========================
    // Show Edit Modal
    // ========================
    $(document).on('click', '.editTourBatchBtn', function () {
        const batchId = $(this).data('id');

        $.get(`/admin/tour-batch/${batchId}`, function (response) {
            if (response.success) {
                const data = response.data;

                $('#tourBatchTableModal').modal('hide');
                $('.tourBatchForm')[0].reset();

                $('#start_date').val(data.start_date);
                $('#end_date').val(data.end_date);
                $('#max_people').val(data.max_people);
                $('#available_seats').val(data.available_seats);
                $('#price').val(data.price);
                $('#status').val(data.status);
                $('#tour_package_id_batch').val(data.tour_package_id);

                $('#tourBatchModal').modal('show');
                $('#submitBatchBtn').hide();
                $('#updateBatchBtn').show();

                $('.tourBatchForm')
                    .attr('id', 'updateTourBatchForm')
                    .attr('data-id', data.id);
            }
        });
    });

    // ========================
    // Load Tour Batch Table (via DataTables)
    // ========================
    $(document).on('click', '.viewTourBatchBtn', function () {
        const packageId = $(this).data('id');
        loadTourBatchTable(packageId);
    });

    function loadTourBatchTable(tourPackageId) {
        $('#tourBatchTableModal').modal('show');

        $('#tour-batch-data-show').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                url: `/admin/tour-batches/${tourPackageId}`,
                type: 'GET'
            },
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'start_date' },
                { data: 'end_date' },
                { data: 'max_people' },
                { data: 'available_seats' },
                { data: 'price' },
                { data: 'status' },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    }

    // ========================
    // Handle Form Submission (Create/Update)
    // ========================
    $(document).off('submit', '.tourBatchForm').on('submit', '.tourBatchForm', function (e) {
        e.preventDefault();

        const form = $(this);
        const formData = new FormData(this);
        const isUpdate = form.attr('id') === 'updateTourBatchForm';
        const url = isUpdate
            ? `/admin/tour-batch/${form.attr('data-id')}`
            : `/admin/tour-batches`;

        if (isUpdate) {
            formData.append('_method', 'PUT');
        }

        $(".btn").prop("disabled", true);

        $.ajax({
            url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // ✅ Force it in request
    },
            success: function (response) {
                $(".btn").prop("disabled", false);

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 1000,
                        showConfirmButton: false
                    });

                    $('#tourBatchModal').modal('hide');
                    // $('#tour-batch-data-show').DataTable().ajax.reload();
                } else {
                    Swal.fire("Error", response.message || "Something went wrong", "error");
                }
            },
            error: function () {
                $(".btn").prop("disabled", false);
                Swal.fire("Error", "Something went wrong!", "error");
            }
        });
    });

    // ========================
    // Delete Tour Batch
    // ========================
    $(document).on('click', '.deleteTourBatchBtn', function () {
        const id = $(this).data('id');

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/tour-batch/${id}`,
                    type: 'DELETE',
                    success: function (response) {
                        if (response.success) {
                            $('#tour-batch-data-show').DataTable().ajax.reload();
                        } else {
                            Swal.fire("Error", response.message || "Deletion failed", "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error", "Could not delete batch!", "error");
                    }
                });
            }
        });
    });

    // ========================
    // Toggle Status (Optional)
    // ========================
    $(document).on('change', '.toggleStatus', function () {
        const id = $(this).data('id');
        const newStatus = $(this).is(':checked') ? 'active' : 'closed';

        $.ajax({
            url: `/admin/tour-batch/${id}`,
            method: 'PUT',
            data: { status: newStatus },
            success: function () {
                $('#tour-batch-data-show').DataTable().ajax.reload();
            }
        });
    });
     $(document).on('change', '.topDealSwitch', function () {
        const id = $(this).data('id');
        const newStatus = $(this).is(':checked') ? 'active' : 'closed';

        $.ajax({
            url: `/admin/tour-batch/${id}`,
            method: 'PUT',
            data: { status: newStatus },
            success: function () {
                $('#tour-batch-data-show').DataTable().ajax.reload();
            }
        });
    });
});
