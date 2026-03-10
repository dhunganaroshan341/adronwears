$(document).ready(function () {
    // Data Table

    var table = $("#show-category-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/category",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [1, 'asc'],
        columns: [{
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false
        }, {
            data: "title",
            name: "title"
        },
        {
            data: "status",
            name: "status",
            orderable: false,
            searchable: false
        },
        {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false
        }
        ]
    });


    // Add Category
    $(document).on("click", ".addCategoryBtn", function () {
        $("#formModal").modal("show");
        $(".updateBtn").hide();
        $(".submitBtn").show();
        $(".form").attr("id", 'addForm');
        $("#addForm")[0].reset();

        // unbinding using off submit
        $(document).off('submit').on("submit", "#addForm", function (event) {
            event.preventDefault();
            $(".submitBtn").prop("disabled", true);
            let formdata = new FormData(this);
            $.ajax({
                type: "post",
                url: "/admin/category/store",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Category Added Successfully",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    table.draw();
                    $("#addForm")[0].reset();
                    $("#formModal").modal("hide");
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "warning",
                        title: "Warning!",
                        text: xhr.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1000
                    });

                },
                complete: function () {
                    $(".submitBtn").prop("disabled", false);
                }
            })
        });
    });

    // Edit Category
    $(document).on("click", ".editUserButton", function () {
        let id = $(this).attr("data-id");
        $("#formModal").modal("show");
        $(".updateBtn").show();
        $(".submitBtn").hide();
        $(".form").attr("id", "updateForm");
        $("#updateForm")[0].reset();
        $("#categoryTitle").text("Edit Category");

        $.ajax({
            type: "get",
            url: "/admin/category/detail/" + id,
            success: function (response) {
                $("#categorytitleData").val(response.message.title);
                $("#categoryStatus").val(response.message.status);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        $(document).off("submit").on("submit", "#updateForm", function (event) {
            event.preventDefault();
            $(".updateBtn").prop("disabled", true);
            let formdata = new FormData(this);
            $.ajax({
                type: "post",
                url: "/admin/category/update/" + id,
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success == true) {

                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Category Updated Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        })
                        table.draw();
                        $("#formModal").modal("hide");
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Something Went Wrong !",
                            text: "Please try again !",
                        })
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "warning",
                        title: "Warning",
                        text: xhr.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                complete: function () {
                    $(".updateBtn").prop("disabled", false);
                }
            })

        })
    });

    // Status Toggle
    $(document).on("change", ".statusIdData", function () {

        let id = $(this).data("id");
        let checkbox = $(this);
        checkbox.prop("disabled", true);
        // console.log(id);
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Change it!",
            cancelButtonColor: "#d33",
        }).then((response) => {
            if (response.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/category/status/" + id,
                    success: function () {
                        // console.log(response);
                        checkbox.prop("disabled", false);
                        table.draw();
                    },
                    error: function (xhr) {
                        checkbox.prop("disabled",false);
                        console.log(xhr.responseJSON.message);
                    }
                })
            } else {
                checkbox.prop("disabled",false);
                checkbox.prop("checked",!checkbox.prop("checked"));
            }
        })

    })

    // Delete Category
    $(document).on("click", ".deleteData", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            text: "You won't be able to rever this !",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes,Delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/category/delete/" + id,
                    success: function (response) {
                        if (response.success == true) {

                            Swal.fire({
                                icon: "success",
                                title: "Sucess",
                                text: "Category Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Already Tagged!",
                                text: "Unable to delete!",
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: "warning",
                            title: "Warning",
                            text: "Something went wrong !",
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            }
        })
    })
})
