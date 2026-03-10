$(document).ready(function () {
    $(".summernote").summernote({
        height: 300
    });
    $('.category_ids').select2({
    placeholder: "Select categories",
    allowClear: true,
      dropdownParent: $("#formModal"),
    width: '100%'
});



    // Data Table
    var table = $("#data-post-show").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "/admin/post/get-data",
            type: "GET",
            cache: false
        },
        // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, 'All']],
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, 'All']],
        order: [[2, 'asc']],
        columns: [{
            target:0,
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            searchable:false,
            orderable:false


        },
        {
            data: "image",
            name: "image",
            orderable:false,
            searchable:false
        },
        {
            data: "title",
            name: "title"
        },
        {
            data: "categories",
            name: "categories"
        },
        {
            data: "description",
            name: "description"
        },
        {
            data: "created_by",
            name: "created_by",
            orderable:false,
            searchable:false
        },
        {
            data: "status",
            name: "status",
            orderable:false,
            searchable:false,
        }, {
            data: "comment",
            name: "comment",
            orderable: false,
            searchable: false
        }, {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false
        },
        ],

    })
function getCategories() {
    return $.ajax({
        url: '/admin/categories', // return array of categories with {id, title}
        type: 'GET'
    });
}

function populateCategorySelect(selectedCategoryIds = []) {
    // getCategories().then(function (categories) {
    //     let $select = $('#category_id');
    //     $select.empty(); // clear old
    //     categories.forEach(function (category) {
    //         let isSelected = selectedCategoryIds.includes(category.id) ? 'selected' : '';
    //         $select.append(`<option value="${category.id}" ${isSelected}>${category.title}</option>`);
    //     });
    //     $select.trigger('change'); // refresh select2
    // });
}




    function clearModal() {
        $("#validationErrors").addClass('d-none').html("");
        $("#post_description").summernote("code", "");
        $(".postImageData").html("");
    }

    // Show Multiple Image Modal
    $(document).on("click", ".imageListPopup", function () {
        $("#imageModal").modal("show");
        $("#postImageTitle").text("Image List");
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            tyoe: "get",
            url: "/admin/post/detail/" + id,
            success: function (response) {
                $(".fetch-post-image-data").html("");
                if (response.images && response.images.length > 0) {

                    response.images.forEach((image, index) => {
                        let imagePath = '/uploads/' + image.path.replace('//',
                            '/');
                        $(".fetch-post-image-data").append(`
                         <div class="carousel-item ${index === 0 ? 'active' : ''} ">
                         <img src="${imagePath}" class="d-block w-100" alt="...">
                         </div>
                        `);
                    });
                }
            }
        })

    })

    // Add Post
    $(document).on("click", ".addPostBtn", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $(".infoPostImageText").text("Multiple Image Can be Uploaded");
        $(".form").attr("id", 'addForm');
        // $("#addForm")[0].reset();
// populateCategorySelect(); // load categories
$("#tags").val('');

        $("#addForm").trigger("reset");
    });

    $(document).off("submit", "#addForm").on("submit", "#addForm", function (event) {
        event.preventDefault();
        $(".submitBtn").prop("disabled", true);
        let formdata = new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/post/store",
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.success ==true){

                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Post Added Successfully",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    table.draw();
                    $("#formModal").modal("hide");
                    $("#addForm")[0].reset();
                    $("#post_description").summernote("code", "");
                }else{
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
    });

    // Edit Post

$(document).on("click", ".editUserButton", function () {
    clearModal();
    let id = $(this).attr("data-id");
    $("#formModal").modal("show");
    $("#postTitle").text("Edit Post");
    $(".submitBtn").hide();
    $(".updateBtn").show();
    $(".form").attr('id', 'updateForm');
    $("#updateForm")[0].reset();

    $.ajax({
        url: "/admin/post/detail/" + id,
        type: "get",
        success: function (response) {
            let data = response.data;

            $("#posttitleData").val(data.title);
            $("#tags").val(data.tags);

            // ✅ Set selected categories directly
            let selectedCategoryIds = data.categories.map(cat => String(cat.id));
            setTimeout(() => {
                $('#category_id').val(selectedCategoryIds).trigger('change');
            }, 100); // allow DOM to fully load options first

            // ✅ Handle post images
            if (data.images && data.images.length > 0) {
                $(".postImageData").html("");
                data.images.forEach((image) => {
                    let imagePath = image.path.replace(/^\/?uploads\/?/, '/uploads/');
                    $(".postImageData").append(`
                        <li class="image-item">
                            <img src="${imagePath}" alt="Image" class="img-thumbnail" width="100">
                            <button type="button" class="btn btn-danger btn-sm remove-image" data-image-id="${image.id}">
                                Remove
                            </button>
                        </li>
                    `);
                });
            } else {
                $(".postImageData").html("");
            }

            // ✅ Set summernote content
            $("#post_description").summernote('code', data.description || '');
        }
    });

    // ✅ Form submit handler
    $(document).off("submit", "#updateForm").on("submit", "#updateForm", function (event) {
        event.preventDefault();
        $(".updateBtn").prop("disabled", true);
        let formdata = new FormData(this);

        $.ajax({
            type: "post",
            url: "/admin/post/edit/" + id,
            data: formdata,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Updated",
                    text: "Post Updated Successfully",
                    showConfirmButton: false,
                    timer: 1500
                });
                $("#formModal").modal("hide");
                table.draw();
            },
            error: function (response) {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    let errorMessages = '<ul>';
                    $.each(errors, function (key, value) {
                        errorMessages += '<li>' + value[0] + '</li>';
                    });
                    errorMessages += '</ul>';
                    $('#validationErrors').removeClass('d-none').html(errorMessages);
                }
            },
            complete: function () {
                $(".updateBtn").prop("disabled", false);
            }
        });
    });
});



    // Image Delete
    $(document).on("click", ".remove-image", function () {
        let imageId = $(this).data("image-id");
        // console.log(id);

        $.ajax({
            type: "get",
            url: "/admin/post/image/delete",
            data: {
                // _token: $('meta[name="csrf-token"]').attr('content'),
                image_id: imageId
            },
            success: function (response) {
                if (response.success) {
                    $(this).parent(".image-item").remove();
                    table.draw();
                }
            }.bind(this),
            error: function (response) {
                console.error("Failed to delete image.");
            }
        });
    });




    // Status Toggle
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        let checkbox = $(this);
        // console.log(id);
        checkbox.prop("disabled", true);
        Swal.fire({
            icon: "warning",
            title: "Are you Sure ?",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes, Change it !"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/post/status/" + id,
                    success: function () {
                        // console.log(response);
                        checkbox.prop("disabled", false);
                        // checkbox.prop("checked", checkbox.prop("checked") ? false : true);
                        table.draw();
                    },
                    error: function (xhr) {
                        checkbox.prop("disabled", false);
                        console.log(xhr.responseJSON.message);
                    }
                })
            } {
                checkbox.prop("disabled", false);
                checkbox.prop("checked", !checkbox.prop("checked"));
            }
        })

    })

    // Delete Post

    $(document).on("click", ".deleteData", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you Sure !",
            text: "You,Won't be able to revert this!",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Yes,Delete it !"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/post/delete/" + id,
                    success: function (response) {
                        if (response.success == true) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: "Post Deleted Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "Unable to Delete",
                                text: response.message
                            });
                        }

                        table.draw();
                    },
                    error: function () {
                        Swal.fire({
                            icon: "warning",
                            title: "Unable to Delete",
                            text: "Something went wrong!"
                        });
                    }
                })
            }
        })
    });


    // Comment of Post
    $(document).on("click", ".commentinfoBtn", function () {
        let id = $(this).attr("data-id");
        // console.log(id);

        $("#commentModal").modal("show");
        $("#postImageTitle").text("Comment List");
        $("#formId").attr('id', 'commentDetail');
        $.ajax({
            type: "get",
            url: "/admin/post/comment/detail/" + id,
            success: function (response) {

                if (response.images && response.images.length > 0) {
                    $(".fetch-comment-data").empty();

                    response.images.forEach((image) => {

                        let imagePath = '/uploads/' + image.image;
                        let content = image.content;
                        console.log(image);


                        $(".fetch-comment-data").append(`
                            <div class="item">
                                <img src="${imagePath}" class="d-block w-50 mx-auto mt-3 mb-3" alt="Image">
                                <div class="caption d-md-block">
                                    <h4>${image.name} : ${content}</h4>
                                </div>
                            </div>
                        `);
                    });
                } else {
                    $(".fetch-comment-data").html(
                        `
                        <div>
                        <h4>No Comment Available</h4>
                        </div>
                        `
                    );
                }
            }
        });

    })
})
