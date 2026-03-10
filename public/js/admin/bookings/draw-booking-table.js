$(document).ready(function () {
    $(".summernote").summernote({
        height: 300
    });

    let currentStatus = 'all'; // Default
    let startDate = '';
    let endDate = '';

    var table = $("#show-booking-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/bookings",
            type: "GET",
            data: function (d) {
                d.status = currentStatus;
                d.startDate = startDate;
                d.endDate = endDate;
                 d.status_filter = $('#statusFilter').val(); // from dropdown/select

            },
            error: function (xhr, status, error) {
                console.error("DataTable AJAX error:", error);
            }
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[11, 'desc']],
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'package', name: 'tourPackage.title', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'booking_type', name: 'booking_type' },
            { data: 'batch', name: 'tourBatch.title', orderable: false, searchable: false },
            { data: 'total_people', name: 'total_people' },
            { data: 'price', name: 'price' },
            { data: 'action', orderable: false, searchable: false },
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data) {
                    return moment(data).format('D MMM, YYYY');
                }
            }
        ],
        dom: 'Blfrtip',
        buttons: [
            { extend: 'print', exportOptions: { columns: [0, 2, 3, 4, 5] } },
            { extend: 'excel', title: '', exportOptions: { columns: [0, 2, 3, 4, 5] } }
        ]
    });

    // Status buttons
    $(document).on('click', '.btn-status-filter', function () {
        currentStatus = $(this).data('status');
        table.draw();
    });

    // Filter button
    $('#filterBtn').on('click', function () {
        startDate = $('#startDate').val();
        endDate = $('#endDate').val();
        table.draw();
    });

    // Reset button
    $('#resetBtn').on('click', function () {
        $('#startDate').val('');
        $('#endDate').val('');
        startDate = '';
        endDate = '';
        currentStatus = 'all';
        table.draw();
    });


    $(document).on('change', '.booking-status', function () {
    let bookingId = $(this).data('id');
    let newStatus = $(this).val();

    $.ajax({
        url: `/admin/bookings/status/${bookingId}`,
        type: 'POST',
        data: {
            status: newStatus,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Status Updated',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Failed to update status!'
                });
            }
        },
        error: function (xhr) {
            Swal.fire({
                icon: 'error',
                title: 'Something went wrong!',
                text: xhr.responseJSON?.message || 'An unknown error occurred.'
            });
            console.error(xhr.responseText);
        }
    });
});

});
