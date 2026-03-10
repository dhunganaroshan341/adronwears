window.StatusService = {
    init(baseUrl, table) {
        $(document).on('change', '.statusIdData', function () {
            const id = $(this).data('id');
            const checkbox = $(this);

            Swal.fire({
                title: 'Change status?',
                showCancelButton: true
            }).then(r => {
                if (r.isConfirmed) {
                    $.get(`${baseUrl}/${id}`, () => table.draw());
                } else {
                    checkbox.prop('checked', !checkbox.prop('checked'));
                }
            });
        });
    }
};
