$(document).ready(function () {
    // Setup CSRF Token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ========================
    // Show Create Modal
    // ========================
    $(document).on('click', '.addPriceIncludeBtn', function () {
        const packageId = $(this).data('id');
        console.log("Package ID clicked:", packageId);


        $('#priceIncludeModal').modal('show');
        $('#priceIncludeForm')[0].reset();

        $('#tour_package_id_for_price_includes').val($(this).data('id'));
        $('#price_include_id').val('');


        $('#submitPriceIncludeBtn').show();
        $('#updatePriceIncludeBtn').hide();

        $('#priceIncludeForm').attr('data-mode', 'create');
    });

    // ========================
    // Show Edit Modal
    // ========================
    $(document).on('click', '.editPriceIncludeBtn', function () {
        const id = $(this).data('id');

        $.get(`/admin/price-includes/show/${id}`, function (response) {
            if (response.success) {
                const data = response.data;

                $('#priceIncludeForm')[0].reset();
                $('#title').val(data.title);
                $('#price').val(data.price);
                // $('#description').val(data.description);
                $(`input[name="is_included"][value="${data.is_included}"]`).prop('checked', true);
                $('#tour_package_id_for_price_includes').val(data.tour_package_id);
                $('#price_include_id').val(data.id);

                $('#priceIncludeModal').modal('show');
                $('#submitPriceIncludeBtn').hide();
                $('#updatePriceIncludeBtn').show();

                $('#priceIncludeForm').attr('data-mode', 'update');
            }
        });
    });

    // ========================
    // Load Price Includes Table
    // ========================
    $(document).on('click', '.viewPriceIncludeBtn', function () {
        const tourPackageId = $(this).data('id');
        loadPriceIncludeTable(tourPackageId);
    });

    function loadPriceIncludeTable(tourPackageId) {
        $('#priceIncludeTableModal').modal('show');
        $('#price-include-data-show').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: `/admin/price-includes/${tourPackageId}`,
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'title' },
                // { data: 'price' },
                // { data: 'description' },
                {
                    data: 'is_included',
                    render: function (data) {
                        return data
                            ? '<span class="badge bg-success">Included</span>'
                            : '<span class="badge bg-danger">Excluded</span>';
                    }
                },
                { data: 'action', orderable: false, searchable: false }
            ]
        });
    }

    // ========================
    // Handle Create/Update Submission
    // ========================
  $('#priceIncludeForm').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const formData = new FormData(this);
    const mode = form.attr('data-mode');
    const id = $('#price_include_id').val();

    // capture last chosen state before reset
    const lastIncluded = $('input[name="is_included"]:checked').val();

    let url = '/admin/price-includes';
    let method = 'POST';

    if (mode === 'update' && id) {
        url = `/admin/price-includes/${id}`;
        formData.append('_method', 'PUT'); // Laravel method spoofing
    }

    $(".btn").prop("disabled", true);

    $.ajax({
        url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $(".btn").prop("disabled", false);

            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 1000,
                    showConfirmButton: false
                });

                form[0].reset();

                // restore last chosen state
                if (lastIncluded !== undefined) {
                    $(`input[name="is_included"][value="${lastIncluded}"]`).prop('checked', true);
                }

                // If you want to reload the table after creation
                // $('#price-include-data-show').DataTable().ajax.reload();
            } else {
                Swal.fire("Error", response.message || "Something went wrong", "error");
            }
        },
        error: function () {
            $(".btn").prop("disabled", false);
            Swal.fire("Error", "Something went wrong!", "error");
        }
    });
});


    // ========================
    // Delete Price Include
    // ========================
    $(document).on('click', '.deletePriceIncludeBtn', function () {
        const id = $(this).data('id');

        Swal.fire({
            icon: 'warning',
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/price-includes/${id}`,
                    type: 'DELETE',
                    success: function (response) {
                        if (response.success) {
                            $('#price-include-data-show').DataTable().ajax.reload();
                        } else {
                            Swal.fire("Error", response.message || "Deletion failed", "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error", "Could not delete price include!", "error");
                    }
                });
            }
        });
    });

    // ========================
    // Optional: Toggle Status
    // ========================
    $(document).on('change', '.togglePriceIncludeStatus', function () {
        const id = $(this).data('id');
        const is_included = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: `/admin/price-includes/${id}/toggle`,
            type: 'PUT',
            data: { is_included },
            success: function () {
                $('#price-include-data-show').DataTable().ajax.reload();
            }
        });
    });
});
