window.FormModal = {
    bind({ modal, addBtn, editBtn, deleteBtn, table, crud, populateEdit }) {

        // --- ADD ---
        $(document).on('click', addBtn, function () {
            $(modal).modal('show');
            $('.updateBtn').hide();
            $('.submitBtn').show();
            $('.form').attr('id', 'addForm')[0]?.reset();
        });

        $(document).on('submit', '#addForm', function (e) {
            e.preventDefault();
            crud.store(new FormData(this), () => {
                Swal.fire('Success', 'Added successfully', 'success');
                table.draw();
                $(modal).modal('hide');
            });
        });

        // --- EDIT ---
        $(document).on('click', editBtn, function () {
            const id = $(this).data('id');
            $(modal).modal('show');
            $('.submitBtn').hide();
            $('.updateBtn').show();
            $('.form').attr('id', 'updateForm');

            // Call resource-specific populate callback
            crud.show(id, res => {
                if (populateEdit && typeof populateEdit === 'function') {
                    populateEdit(res);
                }
            });

            $(document).off('submit', '#updateForm').on('submit', '#updateForm', function (e) {
                e.preventDefault();
                let fd = new FormData(this);
                fd.append('_method', 'PUT');

                crud.update(id, fd, () => {
                    Swal.fire('Updated', 'Updated successfully', 'success');
                    table.draw();
                    $(modal).modal('hide');
                });
            });
        });

        // --- DELETE ---
        $(document).on('click', deleteBtn, function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                showCancelButton: true,
                confirmButtonText: 'Delete'
            }).then(r => {
                if (r.isConfirmed) {
                    crud.destroy(id, () => {
                        Swal.fire('Deleted', '', 'success');
                        table.draw();
                    });
                }
            });
        });
    }
};
