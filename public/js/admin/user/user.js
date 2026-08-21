$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | Summernote
    |--------------------------------------------------------------------------
    */

    $(".summernote").summernote({
        height: 300,
    });


    /*
    |--------------------------------------------------------------------------
    | DataTable
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Show / Hide Password
    |--------------------------------------------------------------------------
    */

    $("#checkbox").on("change", function () {

        $("#password").attr(
            "type",
            this.checked ? "text" : "password"
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Clear Modal
    |--------------------------------------------------------------------------
    */

    function clearModal() {

        $("#validationErrors")
            .addClass("d-none")
            .html("");

        $("#notes_user").summernote("code", "");

        $("#userImage").html("");

        $("#password")
            .val("")
            .attr("type", "password")
            .prop("disabled", false)
            .prop("required", false);

        $("#checkbox").prop("checked", false);

        $("#image").val("");

    }


    /*
    |--------------------------------------------------------------------------
    | Reset Form State
    |--------------------------------------------------------------------------
    */

    function resetFormState() {

        $("#full_name").val("");
        $("#position").val("");
        $("#email").val("");
        $("#password").val("");
        $("#phonenumber").val("");

        $("#email_link").val("");
        $("#facebook_link").val("");
        $("#instagram_link").val("");
        $("#twitter_link").val("");

        $("#image").val("");

        $("#notes_user").summernote("code", "");

        $("#userImage").html("");

        $("#checkbox").prop("checked", false);

        $("#password")
            .attr("type", "password")
            .prop("disabled", false);

    }


    /*
    |--------------------------------------------------------------------------
    | Add User
    |--------------------------------------------------------------------------
    */

    $(document).on("click", ".addUserButton", function () {

        clearModal();
        resetFormState();


        /*
        | Modal title
        */

        $("#formModalTitle").text("Add User");


        /*
        | Buttons
        */

        $(".submitBtn")
            .removeClass("d-none")
            .show()
            .prop("disabled", false);

        $(".updateBtn")
            .addClass("d-none")
            .hide();


        /*
        | Password is REQUIRED when creating
        */

        $(".labelPassword").show();

        $(".passwordRequired").show();

        $("#password")
            .prop("disabled", false)
            .prop("required", true);


        /*
        | Form
        */

        $(".form").attr("id", "storeForm");

        $("#storeForm")[0].reset();


        /*
        | Summernote needs separate reset
        */

        $("#notes_user").summernote("code", "");


        /*
        | Show modal
        */

        $("#formModal").modal("show");

    });


    /*
    |--------------------------------------------------------------------------
    | Store User
    |--------------------------------------------------------------------------
    */

    $(document)
        .off("submit", "#storeForm")
        .on("submit", "#storeForm", function (event) {

            event.preventDefault();


            const form = this;

            const formData = new FormData(form);


            $(".submitBtn")
                .prop("disabled", true);


            $("#validationErrors")
                .addClass("d-none")
                .html("");


            $.ajax({

                type: "POST",

                url: "/admin/user/store",

                data: formData,

                contentType: false,

                processData: false,


                success: function (response) {

                    if (response.success === true) {

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "User Added Successfully",
                            showConfirmButton: false,
                            timer: 1000
                        });


                        table.draw();

                        $("#formModal").modal("hide");

                        resetFormState();

                    }

                },


                error: function (xhr) {

                    if (xhr.status === 422) {

                        showValidationErrors(
                            xhr.responseJSON.errors
                        );

                    }

                },


                complete: function () {

                    $(".submitBtn")
                        .prop("disabled", false);

                }

            });

        });


    /*
    |--------------------------------------------------------------------------
    | Edit User
    |--------------------------------------------------------------------------
    */

    $(document).on("click", ".editUserButton", function () {

        clearModal();


        const id = $(this).data("id");


        /*
        | Modal title
        */

        $("#formModalTitle").text("Edit User");


        /*
        | Buttons
        */

        $(".submitBtn")
            .addClass("d-none")
            .hide();

        $(".updateBtn")
            .removeClass("d-none")
            .show()
            .prop("disabled", false);


        /*
        | Password is visible but OPTIONAL
        */

        $(".labelPassword").show();

        $(".passwordRequired").hide();

        $("#password")
            .val("")
            .prop("disabled", false)
            .prop("required", false);


        /*
        | Form ID
        */

        $(".form").attr("id", "updateForm");


        /*
        | Reset fields
        */

        $("#updateForm")[0].reset();

        $("#notes_user").summernote("code", "");

        $("#userImage").html("");


        /*
        | Show modal
        */

        $("#formModal").modal("show");


        /*
        | Fetch user
        */

        $.ajax({

            type: "GET",

            url: "/admin/user/detail/" + id,


            success: function (response) {

                const user = response.message;


                $("#full_name")
                    .val(user.full_name);

                $("#email")
                    .val(user.email);

                $("#position")
                    .val(user.position);

                $("#phonenumber")
                    .val(user.phonenumber);

                $("#email_link")
                    .val(user.email_link);

                $("#facebook_link")
                    .val(user.facebook_link);

                $("#twitter_link")
                    .val(user.twitter_link);

                $("#instagram_link")
                    .val(user.instagram_link);


                $("#notes_user")
                    .summernote(
                        "code",
                        user.notes || ""
                    );


                /*
                | Existing image
                */

                if (user.image) {

                    $("#userImage").html(`
                        <img
                            src="/uploads/${user.image}"
                            alt="User Image"
                            width="100"
                            height="100"
                            class="mt-2 rounded"
                        >
                    `);

                }

            },


            error: function () {

                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Unable to load user data."
                });

            }

        });


        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $(document)
            .off("submit", "#updateForm")
            .on("submit", "#updateForm", function (event) {

                event.preventDefault();


                const form = this;

                /*
                | IMPORTANT:
                |
                | DO NOT disable #password here.
                |
                | Disabled inputs are NOT included in FormData.
                */

                const formData = new FormData(form);


                $(".updateBtn")
                    .prop("disabled", true);


                $("#validationErrors")
                    .addClass("d-none")
                    .html("");


                $.ajax({

                    type: "POST",

                    url: "/admin/user/update/" + id,

                    data: formData,

                    contentType: false,

                    processData: false,


                    success: function (response) {

                        if (response.success === true) {

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


                    error: function (xhr) {

                        if (xhr.status === 422) {

                            showValidationErrors(
                                xhr.responseJSON.errors
                            );

                        }

                    },


                    complete: function () {

                        $(".updateBtn")
                            .prop("disabled", false);

                    }

                });

            });

    });


    /*
    |--------------------------------------------------------------------------
    | Reset Password
    |--------------------------------------------------------------------------
    */

    $(document).on("click", ".resetUserBtn", function () {

        const id = $(this).data("id");


        Swal.fire({

            title: "Reset Password",

            html: `
                <input
                    id="swal-input2"
                    type="password"
                    placeholder="New Password"
                    class="swal2-input"
                >

                <input
                    id="swal-input3"
                    type="password"
                    placeholder="Confirm Password"
                    class="swal2-input"
                >
            `,

            showCancelButton: true,

            confirmButtonColor: "#3085d3",

            confirmButtonText: "Reset Password",

        }).then(function (result) {

            if (!result.isConfirmed) {
                return;
            }


            const newPassword =
                $("#swal-input2").val();

            const confirmPassword =
                $("#swal-input3").val();


            $.ajax({

                type: "POST",

                url: "/admin/user/reset-password/" + id,

                data: {

                    _token:
                        $('meta[name="csrf-token"]').attr("content"),

                    newPassword:
                        newPassword,

                    confirmPassword:
                        confirmPassword

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

                    } else {

                        Swal.fire({
                            icon: "warning",
                            title: "Warning!",
                            text: response.message
                        });

                    }

                },


                error: function (xhr) {

                    if (xhr.status === 422) {

                        showValidationErrors(
                            xhr.responseJSON.errors
                        );

                    } else {

                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Unable to reset password."
                        });

                    }

                }

            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Delete User
    |--------------------------------------------------------------------------
    */

    $(document).on("click", ".deleteData", function () {

        const itemId = $(this).data("id");


        Swal.fire({

            title: "Are you sure?",

            text: "You won't be able to revert this!",

            icon: "warning",

            showCancelButton: true,

            confirmButtonColor: "#3085d6",

            cancelButtonColor: "#d33",

            confirmButtonText: "Yes, delete it!"

        }).then(function (result) {

            if (!result.isConfirmed) {
                return;
            }


            $.ajax({

                url: "/admin/user/delete/" + itemId,

                type: "DELETE",

                data: {
                    _token: $('meta[name="csrf-token"]').attr("content")
                },


                success: function (response) {

                    if (response.success === true) {

                        Swal.fire({
                            icon: "success",
                            title: "Deleted!",
                            text: "User has been deleted!",
                            showConfirmButton: false,
                            timer: 1000
                        });


                        table.draw();

                    } else {

                        Swal.fire({
                            icon: "warning",
                            title: "Warning",
                            text: response.message ||
                                "User cannot be deleted.",
                            showConfirmButton: false,
                            timer: 1500
                        });

                    }

                },


                error: function () {

                    Swal.fire(
                        "Error!",
                        "An error occurred while deleting the user.",
                        "error"
                    );

                }

            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Validation Error Helper
    |--------------------------------------------------------------------------
    */

    function showValidationErrors(errors) {

        let errorMessages = "<ul class='mb-0'>";


        $.each(errors, function (key, value) {

            if (Array.isArray(value)) {

                errorMessages +=
                    "<li>" + value[0] + "</li>";

            } else {

                errorMessages +=
                    "<li>" + value + "</li>";

            }

        });


        errorMessages += "</ul>";


        $("#validationErrors")
            .removeClass("d-none")
            .html(errorMessages);

    }

});
