$(document).ready(function () {
    $(".summernote").summernote({

        height: 300
    });

    // Data Tables
    var table = $("#show-homeSlide-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/home-slide",
            type: "get"
        },
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[2, 'asc']],
        columns: [
            {
                data: "DT_RowIndex", orderable: false, searchable: false,
                name: "DT_RowIndex",
            },

            {
                data: "image",
                name: "image",
                orderable: false,
                searchable: false
            }, {
                data: "title",
                name: "title",
            }, {
                data: "link_text",
                name: "link_text",
            }, {
                data: "link_url",
                name: "link_url",
            },
            {
                data: "status",
                name: "status",
                searchable: false,
                orderable: false
            },

            {
                data: "action",
                name: "action",
                searchable: false,
                orderable: false,
            }
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 2, 3]
                },
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 2, 3]
                }
            }
        ],
        dom: '<"toolbar">lfrtip',

    })

    $("div.toolbar").html(
        `<button id="btnPrint" class=" btn btn-primary mdi mdi-printer mdi-icon"></button>
        <button id="btnExport" class=" btn btn-secondary mdi mdi-file-export mdi-icon"></button>`
    );

    $("#btnPrint").on('click', function () {
        table.button(0).trigger();
    });

    $("#btnExport").on("click", function () {
        table.button(1).trigger();
    });

    function clearModal() {
        $("#homeSliderDescription").summernote("code", "");
        $("#homeSlideImage").html("");
        $("#validationErrors").addClass("d-none").html('');
    }

    $(document).on("click", ".addHomeSlideBtn", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".updateBtn").hide();
        $(".submitBtn").show();
        $(".form").attr("id", "addForm");
        $('#addForm')[0].reset();
    });

    $(document).off("submit", "#addForm").on("submit", "#addForm", function (event) {
        event.preventDefault();
        $(".submitBtn").prop("disabled", true);
        let formdata = new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/home-slide/store",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success == true) {

                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "HomeSlide Added Successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.draw();
                    $("#addForm")[0].reset();
                    $("#formModal").modal("hide");
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Something went wrong !",
                        text: "Please try again !",
                    });
                }

            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '<ul>';
                    $.each(errors, function (key, value) {
                        errorMessages += '<li>' + value[0] +
                            '</li>'; // Display the first error for each field
                    });
                    errorMessages += '</ul>';
                    $('#validationErrors').removeClass('d-none').html(
                        errorMessages);
                }
            },
            complete: function () {
                $(".submitBtn").prop("disabled", false);
            }
        })
    })


    // Edit
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        let id = $(this).attr("data-id");
        $("#formModal").modal("show");
        $(".updateBtn").show();
        $(".submitBtn").hide();
        $(".form").attr("id", "updateForm");
        $("#updateForm")[0].reset();
        $("#homeSlideTitle").text("Edit Home Slide ");

        $.ajax({
            type: "get",
            url: "/admin/home-slide/detail/" + id,
            success: function (response) {
                console.log(response);
                $("#title_home").val(response.message.title);
                $("#link_text").val(response.message.link_text);
                $("#link_url").val(response.message.link_url);
                if (response.message.image != null) {
                    $("#homeSlideImage").html(`
                <img src="/uploads/${response.message.image}" width="100" height="100">
                `);
                }
                $("#homeSliderDescription").summernote('code', response.message
                    .shortdesc);

            }
        });

        // Update
        $(document).off("submit", "#updateForm").on("submit", "#updateForm", function (event) {
            event.preventDefault();
            // clearModal();
            let formdata = new FormData(this);
            $(".updateBtn").prop("disabled", true);
            $.ajax({
                type: "post",
                url: "/admin/home-slide/update/" + id,
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "Home Slide Updated Successfully",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        table.draw();
                        $("#formModal").modal('hide');
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Something went wrong!",
                            text: "Please try again !",
                        });
                    }
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "warning",
                        title: "Something went wrong",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(".updateBtn").prop("disabled", false);
                },
                complete: function () {
                    $(".updateBtn").prop("disabled", false);
                }
            });
        });
    })
    // Delete Record

    $(document).on("click", ".deleteData", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes,Delete it!",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/home-slide/delete/" + id,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Home Slide Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong!",
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            icon: "warning",
                            title: "Something went wrong!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        })
    })

    // Status Update Toggle Button
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        console.log(id);
        let checked = $(this);
        checked.prop("disabled", true);
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            showCancelButton: true,
            confirmButtonColor: "#3085d3",
            confirmButtonText: "Yes, Change it!",
            cancelButtonColor: "#d33"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/home-slide/status/" + id,
                    success: function (response) {
                        if (response.success == true) {
                            table.draw();
                            checked.prop("disabled", false);
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong!"
                            });
                            checked.prop("disabled", false);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseJSON.message);
                    }
                })
            } else {
                checked.prop("disabled", false);
                checked.prop("checked", !checked.prop("checked"));
            }
        })

    })
})
