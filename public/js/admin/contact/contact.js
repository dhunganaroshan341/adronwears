$(document).ready(function () {

    // Data table
    var table = $("#fetch-contact-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/contact/get-data", // Route to fetch data
            type: "GET",
            cache: false
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, 'All']],
        order: [[1, "asc"]], // Default ordering on the "name" column
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "subject", name: "subject" },
            { data: "message", name: "message", orderable: false, searchable: false },
            { data: "action", name: "action", orderable: false, searchable: false }
        ],
        language: {
            emptyTable: "No data available"
        }
    });



    $(document).on("click", ".messageBtn", function () {
        $("#messageModal").modal("show");
        let id = $(this).attr("data-id");
        console.log(id);
        $.ajax({
            type: "get",
            url: "/admin/contact/detail/" + id,
            success: function (response) {
                $("#contact_subject").text("Subject: " + response.message.subject);
                $("#contact_message").text(response.message.message);
            }

        })
    });

    $(document).on("click", ".contactDeleteBtn", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you Sure ?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes,Delete it!",
            cancelButtonColor: "#d33",
        }).then((response) => {
            if (response.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/contact/delete/" + id,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Contact Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning",
                                text: "Something Went Wrong!",
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                        Swal.fire({
                            icon: "warning",
                            title: "Warning",
                            text: "Something Went Wrong!",
                        });
                    }
                })
            }
        })
    })


})
