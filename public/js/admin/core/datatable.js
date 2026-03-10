window.DataTableService = function (selector, options) {
    const defaults = {
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[0, 'desc']]
    };

    return $(selector).DataTable({
        ...defaults,
        ...options
    });
};
