$(document).ready(function () {
    // Summer note
    $(".summernote").summernote({
        height: 300,
    });

    // Data Table
    var table = $("#show-client-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/client",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "image",
                name: "image",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "type",
                name: "type",
            },
            // {
            //     data: "address",
            //     name: "address",
            // },
            // {
            //     data: "contact",
            //     name: "contact",
            // },
            {
                data: "status",
                name: "status",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });



    function clearModal() {
        $("#validationErrors").addClass("d-none").html("");
        $("#description").summernote("code", "");
        $("#userImage").html("");
    }

    $(document).on("click", ".addClientButton", function () {
        clearModal(); // Clear errors and reset fields
        $(".submitBtn").show();
        $("#password").prop("disabled", false);
        $(".updateBtn").hide();
        $(".labelPassword").show();
        $(".form").attr("id", "storeForm");
        $("#storeForm")[0].reset();
        $("#formModal").modal("show");
    });

    // Add and Store User Data
    $(document).off("submit", "#storeForm").on("submit", "#storeForm", function (event) {
            event.preventDefault();
            $(".submitBtn").prop("disabled", true);
            $("#validationErrors").addClass("d-none").html("");
            let formdata = new FormData(this);
            $.ajax({
                type: "post",
                url: "/admin/client/",
                data: formdata,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Client Added Successfully",
                            showConfirmButton: false,
                            timer: 1000
                        });

                        table.draw();
                        $("#description").summernote("code", "");
                        $("#formModal").modal("hide");
                        $("#storeForm")[0].reset();
                        // $("#storeUserData").trigger("reset");
                    }
                },
                error: function (response) {
                    if (response.status === 422) {
                        let errors = response.responseJSON.errors;
                        let errorMessages = "<ul>";
                        $.each(errors, function (key, value) {
                            errorMessages += "<li>" + value[0] + "</li>"; // Display the first error for each field
                        });
                        errorMessages += "</ul>";
                        $("#validationErrors")
                            .removeClass("d-none")
                            .html(errorMessages);
                    }
                },
                complete: function () {
                    $(".submitBtn").prop("disabled", false);
                },
            });
        });

    // Click and Edit User
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        $(".submitBtn").hide();
        $(".labelPassword").hide();
        $(".updateBtn").show();
        $(".form").attr("id", "updateForm");
        $("#updateForm")[0].reset();
        $("#formModal").modal("show");
        let id = $(this).data("id");

        // $('#password').attr('required', false);
        // Fetch User Data

        $.ajax({
            type: "get",
            url: "/admin/client/" + id,
            success: function (response) {
                $("#full_name").val(response.message.name);
                $("#email").val(response.message.email);
                $("#address").val(response.message.address);
                $("#contact").val(response.message.contact);
                $("#description").summernote("code", response.message.description);

                $("#userImage").html(
                    `<img src="/uploads/${response.message.image}" alt="User Image" width="100" height="100">`
                );
                   // Set type dropdown value
        $("#type").val(response.message.type);
            },
        });

        // Edit and Submit User Data
        $(document)
            .off("submit", "#updateForm")
            .on("submit", "#updateForm", function (event) {
                event.preventDefault();

                let formdata = new FormData(this);
                 formdata.append("_method","put");
                $(".updateBtn").prop("disabled", true);
                // console.log(formdata);
                $.ajax({
                    type: "post",
                    url: "/admin/client/" + id,
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Updated",
                                text: "Client Updated Successfully",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $("#formModal").modal("hide");
                            table.draw();
                        }
                    },
                    error: function (response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            let errorMessages = "<ul>";
                            $.each(errors, function (key, value) {
                                errorMessages += "<li>" + value[0] + "</li>"; // Display the first error for each field
                            });
                            errorMessages += "</ul>";
                            $("#validationErrors")
                                .removeClass("d-none")
                                .html(errorMessages);
                        }
                    },
                    complete: function () {
                        $(".updateBtn").prop("disabled", false);
                    },
                });
            });
    });


    // Delete User
    $(document).on("click", ".deleteData", function () {
        var itemId = $(this).attr("data-id");
        // console.log(itemId);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/client/" + itemId,
                    headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    type: "delete",
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire(
                                "Deleted!",
                                "Client has been deleted!",
                                "success"
                            );
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning",
                                text: "Client Already Tagged in anothe menu",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                    error: function () {
                        Swal.fire(
                            "Error!",
                            "An error occurred while deleting the item.",
                            "error"
                        );
                    },
                });
            }
        });
    });


    // Status Update Toggle Button
    $(document).on("change", ".statusToggle", function () {
    let id = $(this).data("id");
    let checkbox = $(this);
    checkbox.prop("disabled", true);

    Swal.fire({
        icon: "warning",
        title: "Are you sure?",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change it!"
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/client/status/"+id,
                type: "PUT", // Corrected: type instead of "method" and "put"
                data: {
                    status: checkbox.prop("checked") ? "active" : "inactive", // pass status value
                    _token: $('meta[name="csrf-token"]').attr("content") // ensure CSRF token is sent
                },
                success: function () {
                    table.draw();
                    checkbox.prop("disabled", false);
                },
                error: function () {
                    checkbox.prop("disabled", false);
                    checkbox.prop("checked", !checkbox.prop("checked")); // revert change on error
                }
            });
        } else {
            checkbox.prop("disabled", false);
            checkbox.prop("checked", !checkbox.prop("checked"));
        }
    });
});
});
