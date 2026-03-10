$(document).ready(function () {
    $(".summernote").summernote({
        height: 300
    });
    // Data Table
    var table = $("#show-call-to-action-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "call-to-action",
        },
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [2, 'asc'], // Sort by Title column
        columns: [
            { data: "id", name: "id", orderable: false, searchable: false },
            { data: "image", name: "image", orderable: false, searchable: false },
            { data: "page", name: "page" },
            { data: "title", name: "title" },
            { data: "iframe", name: "iframe" },
            { data: "description", name: "description" },
            // { data: "link", name: "link" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "link", name: "link" },
            { data: "action", name: "action", orderable: false, searchable: false }
        ],
        dom: 'Blfrtip',
        buttons: [
            { extend: 'print', exportOptions: { columns: [0, 2, 3, 4, 5] } },
            { extend: 'excel', title: '', exportOptions: { columns: [0, 2, 3, 4, 5] } }
        ],
    });


    $("div.toolbar").html(`
        <span id="btnPrint" class="btn btn-primary mdi mdi-printer mdi-icon"></span>
        <span id="btnExport" class="btn btn-success mdi mdi-file-export mdi-icon"></span>
    `);

    $('#btnPrint').on('click', function () {
        table.button(0).trigger();
    });

    $('#btnExport').on('click', function () {
        table.button(1).trigger();
    });

    function clearModal() {
        $("#callToActionImage").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#description").summernote("code", "");
    }
    $(document).on("click", ".addcallToActionBtn", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $(".form").attr("id", "addForm");
        $("#addForm")[0].reset();
    });



    // Edit and Update
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();
        $(".form").attr("id", "updateForm");
        // $("#updateForm")[0].reset();

        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/call-to-action/"+id,
            success: function (response) {
                console.log(response);
                $("#title").val(response.message.title);
                $("#sub_heading").val(response.message.sub_heading);
                $("#title").val(response.message.iframe);
                $("#formModalLabel").val(response.message.page+' CTA');

                $("#description").summernote('code', response.message
                    .description);
                if (response.message.image != null) {
                    $("#callToActionImage").html(
                        `<img src="/uploads/${response.message.image}"
                                  alt="User Image"
                                  width="100"
                                  height="100"
                                  onerror="this.onerror=404; this.src='/defaultimage/defaultimage.webp';">`
                    );
                } else {
                    $("#callToActionImage").html(
                        `<img src="/defaultimage/defaultimage.webp"
                                  alt="Default Image"
                                  width="100"
                                  height="100">`
                    );
                }


            }
        });

        $("#updateForm").off("submit").on("submit", function (event) {
            event.preventDefault();
            $(".updateBtn").prop("disabled", true);
            let formdata = new FormData(this);
            $.ajax({
                type: "post",
                url: "/admin/call-to-action/" + id,
                data: formdata,
                processData: false,
                contentType: false,
                headers: { 'X-HTTP-Method-Override': 'PUT' },
                success: function (response) {
                    if (response.success == true) {
                        Swal.fire({
                            icon: "success",
                            title: "Success",
                            text: "CTA Updated Successfully",
                            showConfirmButton: false,
                            timer: 1000
                        });
                        table.draw();
                        $("#formModal").modal("hide");
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "Something went wrong!",
                            text: "Please try again!",
                        });
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: "warning",
                        title: "Something went wrong!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(".updateBtn").prop("disabled", false);
                },
                complete: function () {
                    $(".updateBtn").prop("disabled", false);
                }
            })
        })
    })

    // Status Update Toggle Button
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        // console.log(id);
        let checkbox = $(this);
        checkbox.prop("disabled", true);
        Swal.fire({
            icon: "warning",
            title: "Are you sure ?",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Change it !",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/admin/call-to-action/"+ id+"/status" ,
                    headers: { 'X-HTTP-Method-Override': 'PUT' },
                    success: function () {
                        // console.log(response);
                        checkbox.prop("disabled", false);
                        table.draw();
                    },
                    error: function (xhr) {
                        checkbox.prop("disabled", false);
                        console.log(xhr.responseJSON.message);
                    }
                })
            } else {
                checkbox.prop("disabled", false);
                checkbox.prop("checked", !checkbox.prop("checked"));
            }
        })

    })

    $(document).on("click", ".deleteData", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you Sure ?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it !",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/call-to-action/delete/" + id,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "CTA Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            })
                            table.draw();
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Something went wrong!",
                                text: "Please try again!"
                            });
                        }
                    },
                    error: function (response) {
                        console.log(response);
                        Swal.fire({
                            icon: "warning",
                            title: "Something went wrong !",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                })
            }
        })
    })
});
