$(document).ready(function () {
    $(".summernote").summernote({
        height: 300
    });

    // Data Table
    var table = $("#show-team-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/team",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [2, 'asc'], // default order by name
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "image", name: "image", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "position", name: "position" },
            { data: "order", name: "order" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "action", name: "action", orderable: false, searchable: false }
        ],
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: { columns: [0, 2, 3, 4, 5] }
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

    $('#btnPrint').on('click', function () { table.button(0).trigger(); });
    $('#btnExport').on('click', function () { table.button(1).trigger(); });

    function clearModal() {
        $("#teamPhoto").html("");
        $("#validationErrors").addClass("d-none").html("");
        $("#teamDescription").summernote("code", "");
    }

    // Add Team Modal
    $(document).on("click", ".addTeamBtn", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $(".form").attr("id", "addForm");
        $("#addForm")[0].reset();
    });

    // Add Team Submit
    $(document).off("submit", "#addForm").on("submit", "#addForm", function (event) {
        event.preventDefault();
        $(".submitBtn").prop("disabled", true);
        let formdata = new FormData(this);
        $.ajax({
            type: "post",
            url: "/admin/team/store",
            data: formdata,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({ icon: "success", title: "Success", text: "Team Member Created Successfully", showConfirmButton: false, timer: 1000 });
                    table.draw();
                    $("#addForm")[0].reset();
                    $("#formModal").modal("hide");
                } else {
                    Swal.fire({ icon: "warning", title: "Warning", text: "Something went wrong!" });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '<ul>';
                    $.each(errors, function (key, value) { errorMessages += '<li>' + value[0] + '</li>'; });
                    errorMessages += '</ul>';
                    $('#validationErrors').removeClass('d-none').html(errorMessages);
                }
            },
            complete: function () { $(".submitBtn").prop("disabled", false); }
        });
    });

    // Edit and Update Team
    $(document).on("click", ".editUserButton", function () {
        clearModal();
        $("#formModal").modal("show");
        $(".submitBtn").hide();
        $(".updateBtn").show();
        $(".form").attr("id", "updateForm");

        var id = $(this).attr("data-id");
        $.ajax({
            type: "get",
            url: "/admin/team/" + id,
            success: function (response) {
                $("#name").val(response.message.name);
                $("#position").val(response.message.position);
                $("#order").val(response.message.order);
                $("#facebook").val(response.message.facebook);
                $("#twitter").val(response.message.twitter);
                $("#linkedin").val(response.message.linkedin);
                $("#instagram").val(response.message.instagram);
                if (response.message.photo) {
                    $("#teamPhoto").html(`<img src="/uploads/${response.message.photo}" alt="Team Photo" width="100" height="100" onerror="this.onerror=404; this.src='/defaultimage/defaultimage.webp';">`);
                } else {
                    $("#teamPhoto").html(`<img src="/defaultimage/defaultimage.webp" alt="Default Image" width="100" height="100">`);
                }
            }
        });

        $("#updateForm").off("submit").on("submit", function (event) {
    event.preventDefault();

    let id = $("#team_id").val(); // hidden input in your form with team id
    let formdata = new FormData(this);

    $(".updateBtn").prop("disabled", true);

    $.ajax({
        type: "POST",
        url: "/admin/team/" + id,  // matches resource route
        data: formdata,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            "X-HTTP-Method-Override": "PUT" // Laravel expects PUT/PATCH
        },
        success: function (response) {
            if (response.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Team Member Updated Successfully",
                    showConfirmButton: false,
                    timer: 1000
                });
                table.draw();
                $("#formModal").modal("hide");
            } else {
                Swal.fire({
                    icon: "warning",
                    title: "Something went wrong!",
                    text: "Please try again!"
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: "warning",
                title: "Something went wrong!",
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

    // Status Toggle
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
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
                    type: "get",
                    url: "/admin/team/status/" + id,
                    success: function () { checkbox.prop("disabled", false); table.draw(); },
                    error: function (xhr) { checkbox.prop("disabled", false); console.log(xhr.responseJSON.message); }
                });
            } else {
                checkbox.prop("disabled", false);
                checkbox.prop("checked", !checkbox.prop("checked"));
            }
        });
    });

    // Delete Team
    $(document).on("click", ".deleteData", function () {
        let id = $(this).attr("data-id");
        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "get",
                    url: "/admin/team/delete/" + id,
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({ icon: "success", title: "Team Member Deleted Successfully", showConfirmButton: false, timer: 1500 });
                            table.draw();
                        } else {
                            Swal.fire({ icon: "warning", title: "Something went wrong!", text: "Please try again!" });
                        }
                    },
                    error: function () {
                        Swal.fire({ icon: "warning", title: "Something went wrong!", showConfirmButton: false, timer: 1500 });
                    },
                });
            }
        });
    });
});
