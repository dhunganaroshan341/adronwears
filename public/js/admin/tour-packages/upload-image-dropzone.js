Dropzone.autoDiscover = false;

$(function () {
    // Setup CSRF for all ajax
    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
    });

    let imageDropzone;

    // Initialize Dropzone (only once)
    function initDropzone() {
        if (imageDropzone) return;

        imageDropzone = new Dropzone("#mydropzone", {
            url: window.routes.packagesImageUpload,
            paramName: "images",
            method: "POST",
            acceptedFiles: "image/*",
            maxFilesize: 5, // MB
            uploadMultiple: true,
            parallelUploads: 5,
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: "Drag & drop images here or click to upload",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            init: function () {
                // Attach tour_package_id to each upload request
                this.on("sending", function (file, xhr, formData) {
                    formData.append("tour_package_id", $("#tour_package_id").val());
                });

                // On successful upload of all files
                this.on("successmultiple", function () {
                    Swal.fire({
                        icon: "success",
                        title: "Images Uploaded Successfully!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    this.removeAllFiles(true);
                    $("#uploadModal").modal("hide");
                });

                // On error uploading multiple files
                this.on("errormultiple", function (files, response) {
                    Swal.fire({
                        icon: "error",
                        title: "Upload Error",
                        text: typeof response === "string" ? response : "Something went wrong.",
                    });
                    console.error(response);
                });

                // On file removed (click 'Remove file')
                this.on("removedfile", function (file) {
                    // If mock file (existing image) has serverId, delete it from server
                    if (file.serverId) {
                        $.ajax({
                            url: `/admin/tour-package-images/delete/${file.serverId}`,
                            method: "DELETE",
                            headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
                            success: function () {
                                Swal.fire("Deleted!", "Image has been deleted.", "success");
                            },
                            error: function () {
                                Swal.fire("Failed!", "Could not delete image.", "error");
                            },
                        });
                    }
                });
            }
        });
    }

    // Open modal & initialize Dropzone & load existing images
    $(document).on("click", ".editUploads", function () {
        const tourPackageId = $(this).data("id");
        $("#tour_package_id").val(tourPackageId);

        initDropzone();

        // Clear previous files from Dropzone
        imageDropzone.removeAllFiles(true);

        // Load existing images from server
        $.ajax({
            url: `/admin/tour-package-images/${tourPackageId}`,
            method: "GET",
            success: function (images) {
                images.forEach(function (image) {
                    // Create mock file with serverId to identify for deletion
                    const mockFile = {
                        name: image.image_path.split("/").pop(),
                        size: 123456, // dummy size
                        accepted: true,
                        status: Dropzone.SUCCESS,
                        serverId: image.id,
                    };

                    // Emit Dropzone events for mock files
                    imageDropzone.emit("addedfile", mockFile);
                    imageDropzone.emit("thumbnail", mockFile, image.image_path);
                    imageDropzone.emit("complete", mockFile);

                    imageDropzone.files.push(mockFile);
                });
            },
            error: function () {
                console.error("Failed to load existing images");
            },
        });

        $("#uploadModal").modal("show");
    });

    // Submit uploads
    $("#uploadSubmitBtn").click(function () {
        if (!imageDropzone || imageDropzone.getAcceptedFiles().length === 0) {
            Swal.fire({
                icon: "warning",
                title: "No Images Selected",
                text: "Please add some images to upload."
            });
            return;
        }
        imageDropzone.processQueue();
    });

    // Modal close resets dropzone and inputs
    $("#uploadModal").on("hidden.bs.modal", function () {
        if (imageDropzone) {
            imageDropzone.removeAllFiles(true);
        }
        $("#tour_package_id").val("");
        $("#youtubeIframe").val("");
    });
});
