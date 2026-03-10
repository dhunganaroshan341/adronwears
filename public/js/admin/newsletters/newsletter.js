$(document).ready(function () {

    // Setup CSRF token for all AJAX requests (required for Laravel)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // DataTable initialization
var table = $("#show-newsletter-data").DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "/admin/newsletters",
        type: "GET",
        cache: false
    },
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
    order: [[1, "asc"]], // Order by email by default
   columns: [
    { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
    { data: "email", name: "email" },
    { data: "created_at", name: "created_at" },
    { data: "action", name: "action", orderable: false, searchable: false } // Non-db column
],

    language: {
        emptyTable: "No data available"
    }
});



    // Delete button click handler using DELETE method
    $(document).on("click", ".newsletterDeleteBtn", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonColor: "#d33",
        }).then((response) => {
            if (response.isConfirmed) {
                $.ajax({
                    type: "DELETE",  // Use DELETE method here
                    url: "/admin/newsletters/" + id,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted!",
                                text: "Contact deleted successfully.",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            table.draw(); // Refresh datatable
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning",
                                text: "Something went wrong!",
                            });
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Something went wrong!",
                        });
                    }
                });
            }
        });
    });

});
