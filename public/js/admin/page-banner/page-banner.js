$(document).ready(function () {
    $(".summernote").summernote({ height: 300 });

    // Initialize DataTable
    var table = $("#show-page-banner-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/page-banner",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [2, 'asc'],
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "page", name: "page", orderable: false, searchable: false },
            { data: "image", name: "image" },
            { data: "title", name: "title" },
            { data: "section", name: "section" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "action", name: "action", orderable: false, searchable: false }
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: { columns: [0, 2, 3, 4, 5] },
            },
            {
                extend: 'excel',
                title: '',
                exportOptions: { columns: [0, 2, 3, 4, 5] }
            }
        ],
        dom: '<"toolbar">lfrtip',
    });

    $("div.toolbar").html(`
        <span id="btnPrint" class="btn btn-primary mdi mdi-printer mdi-icon"></span>
        <span id="btnExport" class="btn btn-success mdi mdi-file-export mdi-icon"></span>
    `);

    $('#btnPrint').on('click', () => table.button(0).trigger());
    $('#btnExport').on('click', () => table.button(1).trigger());

    function clearModal() {
        $("#bannerImage").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#bannerDescription").summernote("code", "");
    }


    // Edit existing Page Banner
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();
        $(".form").attr("id", "updateForm");

        let id = $(this).attr("data-id");

        $.ajax({
            type: "GET",
            url: "/admin/page-banner/" + id,
            success: function (response) {
                $("#title").val(response.message.title);
                $("#sub_heading").val(response.message.sub_heading);
                $("#page").text(response.message.page);         // FIXED
                $("#section").text(response.message.section);   // FIXED
                $("#image").val(''); // keep file input empty for security

                $("#description").summernote("code", response.message.description);

                let img = response.message.image
                    ? `/uploads/${response.message.image}`
                    : '/defaultimage/defaultimage.webp';

                $("#bannerImage").html(`
                    <img src="${img}" alt="Image" width="100" height="100"
                         onerror="this.onerror=null; this.src='/defaultimage/defaultimage.webp';">
                `);
            }

        });

        // Submit update
       // Submit update
$(document).off("submit", "#updateForm").on("submit", "#updateForm", function (event) {
    event.preventDefault();
    $(".updateBtn").prop("disabled", true);

    let formdata = new FormData(this);
    formdata.append('_method', 'PUT'); // Spoofing method for Laravel

    $.ajax({
        type: "POST", // Must be POST to support PUT spoofing
        url: "/admin/page-banner/" + id,

        data: formdata,
        contentType: false,
        processData: false,
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // in case token isn't in form
        // },
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Page Banner Updated Successfully",
                    timer: 1000,
                    showConfirmButton: false
                });
                table.draw(); // Assuming you're using DataTables or similar
                $("#formModal").modal("hide");
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Warning",
                    text: "Please try again!"
                });
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: "warning",
                title: "Error",
                text: "Something went wrong!",
                timer: 1500,
                showConfirmButton: false
            });
        },
        complete: function () {
            $(".updateBtn").prop("disabled", false);
        }
    });
});

    });

    // Toggle Status
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        let checkbox = $(this);
        checkbox.prop("disabled", true);

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            showCancelButton: true,
            confirmButtonText: "Yes, change it!",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "PUT",
                    url: `/admin/page-banner/${id}/status`,
                    data: { _token: $('meta[name="csrf-token"]').attr("content") },
                    success: function () {
                        table.draw();
                    },
                    error: function (xhr) {
                        console.error(xhr.responseJSON.message);
                    },
                    complete: function () {
                        checkbox.prop("disabled", false);
                    }
                });
            } else {
                checkbox.prop("disabled", false);
                checkbox.prop("checked", !checkbox.prop("checked"));
            }
        });
    });

    // Delete Page Banner
    $(document).on("click", ".deletePageBannerBtn", function () {
        let id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "You won’t be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "/admin/page-banner/" + id + "/delete",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Deleted Successfully", timer: 1500, showConfirmButton: false });
                            table.draw();
                        } else {
                            Swal.fire({ icon: "warning", title: "Failed", text: "Please try again!" });
                        }
                    },
                    error: function () {
                        Swal.fire({ icon: "error", title: "Error", text: "Could not delete item", timer: 1500 });
                    }
                });
            }
        });
    });
});
