$(document).ready(function () {
    let table = $('#fetch-service-query-data').DataTable({
        processing: true,
        serverSide: true,
        searching: true, // <-- This is true by default, but be explicit
        ajax: {
            url: '/admin/service-query/get-data'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'service_name', name: 'service_name' },
            // { data: 'message', name: 'message', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });

    // Show message modal
  $(document).on('click', '.messageBtn', function () {
    let id = $(this).data('id');
    $.ajax({
        url: '/admin/service-query/detail/' + id,
        method: 'GET',
        success: function (response) {
            if (response.success) {
                $('#service_query_name').html(response.message.name);
                $('#service_query_message').html(response.message.message);
                $('#serviceQueryMessageModal').modal('show');
            } else {
                alert("Could not fetch details");
            }
        },
        error: function () {
            alert("Error while fetching message.");
        }
    });
});



    // Delete record
    $(document).on('click', '.serviceQueryDeleteBtn', function () {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this service query?')) {
            $.ajax({
                url: '/admin/service-query/delete/'+id,
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        table.ajax.reload();
                        alert("Deleted successfully");
                    } else {
                        alert("Could not delete");
                    }
                },
                error: function () {
                    alert("Error while deleting record.");
                }
            });
        }
    });
});
