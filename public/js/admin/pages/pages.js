$(document).ready(function () {
    $(".summernote").summernote({ height: 300 });
    $(document).ready(function () {
    $('#short_desc1').summernote({
        placeholder: 'Generally used in subheading'
    });

    $('#short_desc2').summernote({
        placeholder: 'Generally used in subheading'
    });

    $('#desc1').summernote({
        placeholder: 'Generally section contents'
    });

    $('#desc2').summernote({
        placeholder: 'Generally section contents'
    });

    $('#content').summernote({
        placeholder: 'Hero content of the page'
    });
});
// End of summernote , filling datatable


 const table = $("#show-page-data").DataTable({
    processing: true,
    serverSide: true,
    ajax: "/admin/pages",
    order: [1, 'asc'],
    columns: [
        { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
        { data: "title", name: "title" },
        { data: "slug", name: "slug" },
        { data: "status", name: "status", orderable: false, searchable: false },
        { data: "action", name: "action", orderable: false, searchable: false }
    ],
    buttons: [
        {
            extend: 'print',
            exportOptions: { columns: [0, 1, 2, 3] },
        },
        {
            extend: 'excel',
            exportOptions: { columns: [0, 1, 2, 3] }
        }
    ],
    dom: '<"toolbar">Blfrtip',
});


    $("div.toolbar").html(`
        <span id="btnPrint" class="btn btn-primary mdi mdi-printer mdi-icon"></span>
        <span id="btnExport" class="btn btn-success mdi mdi-file-export mdi-icon"></span>
    `);

    $('#btnPrint').on('click', () => table.button(0).trigger());
    $('#btnExport').on('click', () => table.button(1).trigger());

    // Clear modal
    function clearModal() {
        $("#pageForm")[0].reset();
        $(".summernote").summernote("code", "");
        $("#validationErrors").addClass("d-none").html("");
        $("#page_id").val("");
        $(".submitBtn").show();
        $(".updateBtn").addClass("d-none");
    }
function loadPreview(data) {
    const baseUrl = window.location.origin; // Automatically gets https://bivekp23.sg-host.com or http://localhost

    // Clear existing previews
    $('#preview_image1, #preview_image2, #preview_video1, #preview_video2').html('');

    // Image 1
    if (data.image1) {
        $('#preview_image1').html(`<img src="${baseUrl}/${data.image1}" class="img-thumbnail" width="150">`);
    } else {
        $('#preview_image1').html(`<span class="text-danger">No image found for Image 1.</span>`);
    }

    // Image 2
    if (data.image2) {
        $('#preview_image2').html(`<img src="${baseUrl}/${data.image2}" class="img-thumbnail" width="150">`);
    } else {
        $('#preview_image2').html(`<span class="text-danger">No image found for Image 2.</span>`);
    }

    // Video 1
    if (data.video1) {
        $('#preview_video1').html(`
            <video width="150" controls>
                <source src="${baseUrl}/${data.video1}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        `);
    } else {
        $('#preview_video1').html(`<span class="text-danger">No video found for Video 1.</span>`);
    }

    // Video 2
    if (data.video2) {
        $('#preview_video2').html(`
            <video width="150" controls>
                <source src="${baseUrl}/${data.video2}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        `);
    } else {
        $('#preview_video2').html(`<span class="text-danger">No video found for Video 2.</span>`);
    }
}



    // Show create modal
$(".addNewPageBtn").on("click", function () {
    clearModal();
    $("#formModal").modal("show");
    $(".submitBtn").show(); // Show the submit button
    $(".updateBtn").hide(); // Hide the update button
});


    // Edit page

    $(document).on("click", ".editUserButton", function () {
        clearModal();
        let id = $(this).data("id");
          $(".submitBtn").hide(); // Show the submit button
    $(".updateBtn").show(); // Hide the update button

        $.ajax({
            url: `/admin/pages/${id}`,
            type: "GET",
            success: function (res) {
                const data = res.data;
                loadPreview(data);
                $("#page_id").val(data.id);
                $("#title").val(data.title);
                $("#slug").val(data.slug);
                $("#content").summernote("code", data.content);

                $("#meta_title").val(data.meta_title);
                $("#meta_description").val(data.meta_description);
                $("#meta_keywords").val(data.meta_keywords);

                $("#title1").val(data.title1);
                $("#content_heading").val(data.content_heading);
                $("#content_subheading").val(data.content_subheading);
                $("#title2").val(data.title2);
                $("#short_desc1").summernote(data.short_desc1);
                $("#short_desc2").summernote(data.short_desc2);

                $("#desc1").summernote("code", data.desc1);
                $("#desc2").summernote("code", data.desc2);

                $(".submitBtn").hide();
                $(".updateBtn").removeClass("d-none");

                $("#formModal").modal("show");
            },
            error: function () {
                Swal.fire({ icon: "error", title: "Error", text: "Failed to load page data." });
            }
        });
    });

    // Submit Create or Update
    $(document).on("submit", "#pageForm", function (e) {
        e.preventDefault();

        let id = $("#page_id").val();
        let method = id ? "POST" : "POST";
        let url = id ? `/admin/pages/${id}` : "/admin/pages";
        let formData = new FormData(this);

        if (id) formData.append("_method", "PUT");

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Success", text: res.message, timer: 1200, showConfirmButton: false });
                    $("#formModal").modal("hide");
                    table.draw();
                } else {
                    Swal.fire({ icon: "warning", title: "Warning", text: res.message || "Please try again" });
                }
            },
            error: function (xhr) {
                const errors = xhr.responseJSON.errors;
                let errorHtml = "<ul>";
                for (let key in errors) {
                    errorHtml += `<li>${errors[key][0]}</li>`;
                }
                errorHtml += "</ul>";
                $("#validationErrors").removeClass("d-none").html(errorHtml);
            }
        });
    });

    // Toggle Status
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

    // Delete Page
    $(document).on("click", ".deletePageBtn", function () {
        const id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "This action cannot be undone!",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/pages/${id}`,
                    type: "DELETE",
                    data: { _token: $('meta[name="csrf-token"]').attr("content") },
                    success: function (res) {
                        if (res.success) {
                            Swal.fire({ icon: "success", title: "Deleted", timer: 1000, showConfirmButton: false });
                            table.draw();
                        } else {
                            Swal.fire({ icon: "error", title: "Failed", text: res.message || "Something went wrong." });
                        }
                    }
                });
            }
        });
    });
