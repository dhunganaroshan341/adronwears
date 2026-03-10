$(document).ready(function () {
    const crud = new CrudService("/admin/product-categories");

    const table = DataTableService("#show-category-data", {
        ajax: crud.baseUrl,
        order: [[1, 'asc']],
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
            { data: "name", name: "name" },
            { data: "parent_category", name: "parent_category" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "action", name: "action", orderable: false, searchable: false }
        ]
    });
    FormModal.bind({
        modal: "#formModal",
        addBtn: ".addCategoryBtn",
        editBtn: ".editUserButton",
        deleteBtn: ".deleteData",
        table: table,
        crud: crud,
        populateEdit: function (res) {
            $("#categorytitleData").val(res.message.name);
            $("#categoryParent").val(res.message.parent__category);
            $("#categoryStatus").val(res.message.status);
        }
    });
    $(document).on("change", ".statusIdData", function () {
        const id = $(this).data("id");
        const checkbox = $(this);
        checkbox.prop("disabled", true);

        Swal.fire({
            icon: "warning",
            title: "Are you sure?",
            showCancelButton: true,
            confirmButtonText: "Yes, Change it!"
        }).then(result => {
            if (result.isConfirmed) {
                $.get(`/admin/product-categories/status/${id}`)
                    .done(() => table.draw())
                    .fail(xhr => console.log(xhr.responseJSON.message))
                    .always(() => checkbox.prop("disabled", false));
            } else {
                checkbox.prop("disabled", false).prop("checked", !checkbox.prop("checked"));
            }
        });
    });
});
