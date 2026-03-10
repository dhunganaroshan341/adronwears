$(document).ready(function () {

    // ========================
    // 1. GLOBAL AJAX CSRF SETUP
    // ========================
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ========================
    // 2. INITIALIZE Summernote
    // ========================
    $(".summernote").summernote({ height: 300 });

    // ========================
    // 3. INITIALIZE DATATABLE
    // ========================
    const table = $("#show-achievement-data").DataTable({
        processing: true,
        serverSide: true,
        ajax: "/admin/achievements", // Laravel resource index route
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[2, 'asc']],
        columns: [
            { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "fontawesome_icon", orderable: false, searchable: false },
            { data: "title" },
            { data: "count" },
            { data: "status", orderable: false, searchable: false },
            { data: "action", orderable: false, searchable: false }
        ],
        dom: 'Blfrtip',
        buttons: [
            { extend: 'print', exportOptions: { columns: [0, 2, 3, 4] } },
            { extend: 'excel', exportOptions: { columns: [0, 2, 3, 4] } }
        ]
    });

    // ========================
    // 4. HELPER FUNCTIONS
    // ========================
    function clearModalForm() {
        $("#achievementForm")[0].reset();
        $("#validationErrors").addClass("d-none").html("");
        $("#description").summernote?.("code", ""); // optional if you have description
        $(".submitBtn").show();
        $(".updateBtn").hide();
        $("#achievementForm").removeAttr("data-id"); // clear update ID
    }

    function showValidationErrors(errors) {
        let html = '<ul>';
        $.each(errors, (key, messages) => {
            html += `<li>${messages[0]}</li>`;
        });
        html += '</ul>';
        $('#validationErrors').removeClass('d-none').html(html);
    }

    // ========================
    // 5. ADD ACHIEVEMENT
    // ========================
    $(document).on("click", ".addAchievementBtn", function () {
        clearModalForm();
        $("#formModal").modal("show");
    });

    $(document).on("submit", "#achievementForm:not([data-id])", function (e) {
        e.preventDefault();
        $(".submitBtn").prop("disabled", true);

        let formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "/admin/achievements/store",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Achievement Created", timer: 1000, showConfirmButton: false });
                    $("#formModal").modal("hide");
                    table.draw();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(xhr.responseJSON.errors);
                }
            },
            complete: function () {
                $(".submitBtn").prop("disabled", false);
            }
        });
    });

    // ========================
    // 6. EDIT ACHIEVEMENT
    // ========================
    $(document).on("click", ".editUserButton", function () {
        clearModalForm();
        const id = $(this).data("id");

        // Set form mode to UPDATE
        $("#achievementForm").attr("data-id", id);
        $(".submitBtn").hide();
        $(".updateBtn").show();

        // Fetch existing data
        $.get(`/admin/achievements/${id}`, function (res) {
            $("#title").val(res.message.title);
            $("#icon_class").val(res.message.icon_class);
            $("#count").val(res.message.count);
            $("#formModal").modal("show");
        });
    });

    // ========================
    // 7. UPDATE ACHIEVEMENT
    // ========================
    $(document).on("submit", "#achievementForm[data-id]", function (e) {
        e.preventDefault();
        $(".updateBtn").prop("disabled", true);

        const id = $(this).attr("data-id");
        let formData = new FormData(this);
        formData.append("_method", "PUT"); // Laravel expects PUT for update

        $.ajax({
            type: "POST",
            url: `/admin/achievements/${id}`,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    Swal.fire({ icon: "success", title: "Updated Successfully", timer: 1000, showConfirmButton: false });
                    $("#formModal").modal("hide");
                    table.draw();
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    showValidationErrors(xhr.responseJSON.errors);
                }
            },
            complete: function () {
                $(".updateBtn").prop("disabled", false);
            }
        });
    });

    // ========================
    // 8. STATUS TOGGLE
    // ========================
    $(document).on("change", ".statusIdData", function () {
        const id = $(this).data("id");
        const checkbox = $(this);
        checkbox.prop("disabled", true);

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            showCancelButton: true
        }).then(result => {
            if (result.isConfirmed) {
                $.get(`/admin/achievements/status/toggle/${id}`, () => table.draw())
                    .always(() => checkbox.prop("disabled", false));
            } else {
                checkbox.prop("disabled", false).prop("checked", !checkbox.prop("checked"));
            }
        });
    });

    // ========================
    // 9. DELETE ACHIEVEMENT
    // ========================
    $(document).on("click", ".deleteAchievementBtn", function () {
        const id = $(this).data("id");

        Swal.fire({
            icon: "warning",
            title: "Delete?",
            text: "This cannot be undone",
            showCancelButton: true
        }).then(result => {
            if (result.isConfirmed) {
                $.get(`/admin/achievements/delete/${id}`, function (res) {
                    if (res.success) {
                        Swal.fire({ icon: "success", title: "Deleted", timer: 1500, showConfirmButton: false });
                        table.draw();
                    }
                });
            }
        });
    });
});
