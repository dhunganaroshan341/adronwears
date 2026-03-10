$(document).ready(function () {

    function toggleMediaFields() {
            var selectedType = $('#type').val();

            if (selectedType === 'image') {
                // Show image-related fields
                $('#galleryMedia').closest('.col-md-12').show();
                $('#thumbnailImage').parent().show();
                $('#url-group').hide();
            } else if (selectedType === 'video' || selectedType === 'url') {
                // Show URL field, hide image-related
                $('#url-group').show();
                $('#galleryMedia').closest('.col-md-12').hide();
                $('#thumbnailImage').parent().hide();
            } else {
                // Default state
                $('#galleryMedia').closest('.col-md-12').hide();
                $('#thumbnailImage').parent().hide();
                $('#url-group').hide();
            }
        }


    function uploadThumbnail(albumId, formElement) {
        let formData = new FormData(formElement);

        $.ajax({
            type: "POST",
            url: `/admin/gallery-albums/${albumId}/upload`,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $("#thumbnailImage").attr("src", `/uploads/${response.filename}`);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to upload thumbnail.",
                    });
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Upload Error",
                    text: xhr.responseJSON?.message || "Something went wrong while uploading thumbnail.",
                });
            }
        });
    }

    // Initialize DataTable
    var table = $("#data-album-show").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/gallery-albums/data",

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [2, 'asc'],
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "title", name: "title" },
             { data: "gallery", name: "gallery" },
            { data: "type", name: "type" },
            { data: "client", name: "client" },
            { data: "status", name: "status" },
            { data: "action", name: "action", orderable: false, searchable: false }
        ]
    });

    // Add Gallery Album
    $(document).on("click", ".addGalleryAlbumBtn", function () {
        $("#formModal").modal("show");
        $(".updateBtn").hide();
        $("#thumbnailImage").hide();
        $(".submitBtn").show();
        $(".form").attr("id", 'addForm');

         // Initialize on page load
        toggleMediaFields();

        // Re-evaluate on dropdown change
        $('#type').on('change', function () {
            toggleMediaFields();
        });
        $("#addForm")[0].reset();
    });

    $(document).off('submit',"#addForm").on("submit", "#addForm", function (e) {
        e.preventDefault();
        $(".submitBtn").prop("disabled", true);
        let formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: "/admin/gallery-albums",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Album added successfully",
                    showConfirmButton: false,
                    timer: 1000
                });
                table.draw();
                $("#formModal").modal("hide");
            },
            error: function (xhr) {
                Swal.fire({
                    icon: "warning",
                    title: "Warning",
                    text: xhr.responseJSON?.message || "Validation error",
                    showConfirmButton: false,
                    timer: 1500
                });
            },
            complete: function () {
                $(".submitBtn").prop("disabled", false);
            }
        });
    });

    // Edit Gallery Album
    $(document).on("click", ".editAlbumButton", function () {
        let id = $(this).data("id");

        // Open the modal and reset the form
        $("#formModal").modal("show");
        $(".submitBtn").hide();
        $("#thumbnailImage").show();
        $(".updateBtn").show();
        $(".form").attr("id", "updateForm");
        $("#updateForm")[0].reset();
        $("#albumModalLabel").text("Edit Gallery Album");
      $("#type").hide();
               // Correctly hides the type <select>
    $("#url-group").hide();    // Hides the whole URL input group (label + input)
    $("#type-group").hide();    // Hides the whole URL input group (label + input)

        // loading show
                 $("#loading-paragraph").val('...loading..');
                 $("#title").val('...loading..');
        //end of loading show

        $.ajax({
            type: "GET",
            url: `/admin/gallery-albums/${id}/detail`,

            success: function (response) {
                if (response.success) {
                    let album = response.message; // 👈 use message instead of album
                    $("#loading-paragraph").val('');
                    $("#title").val(album.title);
                    $("#type").val(album.type);

                    $("#client_id").val(album.client_id);
                    if (album.gallery_media && album.gallery_media.length > 0) {
                        $(".galleryMediaData").html(""); // clear first

                        album.gallery_media.forEach((image) => {
                            let imagePath = image.media_path; // Full URL already
                             imagePath = '/uploads/'.imagePath; // Full URL already

                            $(".galleryMediaData").append(`
                                <div class="col-4 mb-3">
                                    <div class="position-relative">
                                        <img src="/${imagePath}" alt="Image" class="img-thumbnail w-100" style="height: 150px; object-fit: cover;">
                                       <button type="button" class="btn btn-sm text-danger position-absolute top-0 end-0 m-1 remove-image"
        data-image-id="${image.id}" title="Remove Image"
        style="width: 30px; height: 30px; line-height: 1;">
    <span style="font-size: 24px;">&times;</span>
</button>

                                    </div>
                                </div>
                            `);
                        });
                    }

                    $("#status").val(album.status);
                    $("#thumbnailImage").attr("src", album.thumbnail ? `${album.thumbnail}` : '/images/default.png');
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to load album data.",
                    });
                }
            },

            error: function (xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to load album data. Please try again.",
                });
            }
        });


        $(document).off("submit").on("submit", "#updateForm", function (event) {
            event.preventDefault();
            $(".updateBtn").prop("disabled", true);
            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: `/admin/gallery-albums/${id}`,
                data: formData,
                processData: false,
                contentType: false,
                headers: { 'X-HTTP-Method-Override': 'PUT' },
                success: function () {
                    Swal.fire({
                        icon: "success",
                        title: "Updated",
                        text: "Album updated successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.draw();
                    $("#formModal").modal("hide");
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: "warning",
                        title: "Error",
                        text: xhr.responseJSON?.message || "Update failed",
                        showConfirmButton: false,
                        timer: 1500
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
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, change it!"
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/gallery-albums/" + id + "/status",
                type: "PUT", // Corrected: type instead of "method" and "put"
                data: {
                    status: checkbox.prop("checked") ? 1 : 0, // pass status value
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


    // Delete Album
    $(document).on("click", ".deleteData", function () {
        let id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "This action cannot be reversed!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then(result => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: `/admin/gallery-albums/${id}`,
                    success: function (response) {
                        Swal.fire({
                            icon: "success",
                            title: "Deleted",
                            text: "Album deleted successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        table.draw();
                    },
                    error: function () {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Failed to delete album",
                        });
                    }
                });
            }
        });
    });


 // Show Multiple Image Modal
 $(document).on("click", ".imageListPopup", function () {
    $("#imageModal").modal("show");
    $("#postImageTitle").text("Image List");

    let id = $(this).data('id');

    $.ajax({
        type: "get", // fixed typo
        url: "/admin/gallery-albums/" + id + "/detail",
        success: function (response) {
            $(".fetch-post-image-data").html("");

            // Access gallery_media from the response
            if (response.message.gallery_media && response.message.gallery_media.length > 0) {
                response.message.gallery_media.forEach((media, index) => {
                    let imagePath = media.media_path; // it's already a full URL
                     imagePath =  '/uploads/'. imagePath; // it's already a full URL
                    $(".fetch-post-image-data").append(`
                        <div class="carousel-item ${index === 0 ? 'active' : ''}">
                            <img src="/${imagePath}" class="d-block w-100" alt="...">
                        </div>
                    `);
                });
            }
        }
    });
});

// delete media from Gallery edit button modal
$(document).on("click", ".remove-image", function () {
    let imageId = $(this).data("image-id");
    // console.log(id);

    $.ajax({
        type: "get",
        url: "/admin/gallery-albums/image/delete",
        data: {
            // _token: $('meta[name="csrf-token"]').attr('content'),
            image_id: imageId
        },
        success: function (response) {
            if (response.success) {
                $(this).closest(".col-4").fadeOut(300, function () {
                    $(this).remove();
                });

                table.draw();
            }
        }.bind(this),
        error: function (response) {
            console.error("Failed to delete image.");
        }
    });
});

});
