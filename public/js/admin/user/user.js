$(document).ready(function () {
    // Summer note
    $(".summernote").summernote({
        height: 300,
    });

    // Data Table
    var table = $("#show-user-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/user",
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
                data: "full_name",
                name: "full_name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "position",
                name: "position",
            },
            {
                data: "phonenumber",
                name: "phonenumber",
            },
            {
                data: "role",
                name: "role",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $("#checkbox").on("change", function () {
        if ($("#password").prop("type") == "password") {
            $("#password").prop("type", "text");
        } else {
            $("#password").prop("type", "password");
        }
    });

    function clearModal() {
        $("#validationErrors").addClass("d-none").html("");
        $("#notes_user").summernote("code", "");
        $("#userImage").html("");
    }

    $(document).on("click", ".addUserButton", function () {
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
                url: "/admin/user/store/",
                data: formdata,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "User Added Successfully",
                            showConfirmButton: false,
                            timer: 1000
                        });

                        table.draw();
                        $("#notes_user").summernote("code", "");
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
            url: "/admin/user/detail/" + id,
            success: function (response) {
                $("#full_name").val(response.message.full_name);
                $("#email").val(response.message.email);
                $("#position").val(response.message.position);
                $("#phonenumber").val(response.message.phonenumber);
                $("#email_link").val(response.message.email_link);
                $("#facebook_link").val(response.message.facebook_link);
                $("#twitter_link").val(response.message.twitter_link);
                $("#instagram_link").val(response.message.instagram_link);
                $("#notes_user").summernote("code", response.message.notes);

                $("#userImage").html(
                    `<img src="/uploads/${response.message.image}" alt="User Image" width="100" height="100">`
                );
            },
        });

        // Edit and Submit User Data
        $(document)
            .off("submit", "#updateForm")
            .on("submit", "#updateForm", function (event) {
                event.preventDefault();
                $("#password").prop("disabled", true);

                let formdata = new FormData(this);
                $(".updateBtn").prop("disabled", true);
                // console.log(formdata);
                $.ajax({
                    type: "post",
                    url: "/admin/user/update/" + id,
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Updated",
                                text: "User Updated Successfully",
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

    // Reset Password
    $(document).on("click", ".resetUserBtn", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            title: "Enter you Password",
            // input: "password",
            // inputLabel: "Password",
            inputPlaceholder: "Enter your current password",
            // inputAttributes: {
            //     autocorrect: "off"
            // },
            html: `
                   <input id="swal-input2"  type="password" placeholder="New Password" class=" swal2-input">
                   <input id="swal-input3"  type="password" placeholder="Confirm Password" class="swal2-input">
                 `,
            showCancelButton: true,
            confirmButtonColor: "#3085d3",
            confirmButtonText: "Reset Password",
        }).then((result) => {
            if (result.isConfirmed) {
                let newPassword = $("#swal-input2").val();
                let confirmPassword = $("#swal-input3").val();

                $.ajax({
                    type: "post",
                    url: "/admin/user/reset-password/" + id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        // _token: $('meta[name="csrf-token"]').attr('content'),
                        newPassword: newPassword,
                        confirmPassword: confirmPassword,
                    },
                    success: function (response) {
                        if (response.success === true) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1000
                            });
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning!",
                                text: response.message,
                            });
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    },
                });
            }
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
                    url: "/admin/user/delete/" + itemId,
                    type: "get",
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire(
                                "Deleted!",
                                "User has been deleted!",
                                "success"
                            );
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Warning",
                                text: "User Already Tagged in anothe menu",
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
});
