$(document).ready(function () {

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// table



    let itineraryItems = [];

    let currentDay = 1;
$(document).on('click', '.addItineraryBtn', function () {
        $('.itineraryForm').attr('id', 'ItineraryForm');

        const id = $(this).data('id');
        // console.log("Tour Package ID:", modalEl);

        $("#itineraryModal").modal("show");
        // Hide submit button and show update

$('#updateItineraryBtn').hide();
        $('#tour_package_id').val(id);
        $('#day_number').val(1);

       $.ajax({
        url: `/admin/itineraries/latest-order/${id}`,
        type: 'GET',
        success: function (response) {
            // Populate form fields with data
            $('#order').val(response.latest_order + 1);


        },
        error: function (err) {
            console.error("Error fetching itinerary:", err);
            alert("Failed to fetch itinerary for editing.");
        }
    });});
$(document).on('click', '.viewItineraryBtn', function () {
        const id = $(this).data('id');
        // console.log("Tour Package ID:", modalEl);

        $("#itineraryTableModalUnique").modal("show");
        // const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
        // fetchItineraries(modalEl);
        $("#itinerary-data-album-show").DataTable().destroy(); // Destroy existing DataTable if any

        getItineraryTable(id);

    });






   $(document).on('click', '.editItineraryBtn', function () {
    const itineraryId = $(this).data('id');
    $('.itineraryForm').attr('id', 'updateItineraryForm');
    $("#updateItineraryForm").attr("data-id", itineraryId); // ✅ Add this line
    // Open the modal
    $('#itineraryModal').modal('show');

    // Hide submit button and show update
    $('#submitItineraryBtn').hide();
$('#updateItineraryBtn').show();


    // Set the ID on update button for reference


    // Fetch the itinerary data
    $.ajax({
        url: `/admin/itineraries/show/${itineraryId}`,
        type: 'GET',
        success: function (response) {
            // Populate form fields with data
            $('#day_number').val(response.day_number);
            $('#title').val(response.title);
            $('#description').val(response.description);
            $('#tour_package_id').val(response.tour_package_id);
            $('#order').val(response.order);

         response.tour_package_id;
        },
        error: function (err) {
            console.error("Error fetching itinerary:", err);
            alert("Failed to fetch itinerary for editing.");
        }
    });



});




    function getItineraryTable(id) {
        // Initialize DataTable
      itineraryTable = $("#itinerary-data-album-show").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: "/admin/itineraries/"+id,
        type: "GET"
    },
    columns: [
        { data: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'order', name: 'order' },
        { data: 'title', name: 'title' },
        { data: 'day_number', name: 'day_number' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
    });
    }






$(document).off("submit", ".itineraryForm").on("submit", ".itineraryForm", function (e) {
    e.preventDefault();

    let form = $(this);
    let formData = new FormData(this);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    let isUpdate = form.attr("id") === "updateItineraryForm";
    let url = '';
    let method = 'POST';

    // Always append tour_package_id
    formData.append('tour_package_id', $('#tour_package_id').val());

    if (isUpdate) {
        $('#updateItineraryBtn').show();
        $('#submitItineraryBtn').hide();
        const id = form.attr("data-id");
        url = `/admin/itineraries/update/${id}`;
    } else {
        url = '/admin/itineraries/store';
    }

    $(".btn").prop("disabled", true);

    $.ajax({
        url: url,
        type: method,
        data: formData,
        contentType: false,
        processData: false,

        success: function (response) {
            $(".btn").prop("disabled", false);

            if (response.success) {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: response.message || "Itinerary saved successfully.",
                    showConfirmButton: false,
                    timer: 1000
                });

                // Reload DataTable if it exists
                if (typeof itineraryTable !== 'undefined' && itineraryTable) {
                    itineraryTable.ajax.reload(null, false);
                }

                // Increment the order by 1 regardless of response
                let currentOrder = parseInt($('#order').val()) || 0;
                $('#order').val(currentOrder + 1);

                if (isUpdate) {
                    // Update case: close modal
                    $("#itineraryModal").modal("hide");
                    form.attr("id", "itineraryForm"); // Reset form to create mode
                    $('#submitItineraryBtn').show();
                    $('#updateItineraryBtn').hide();
                } else {
                    // Create case: keep modal open, just reset fields
                    form[0].reset();
                    // Keep incremented order value
                    $('#order').val(currentOrder + 1);
                }

            } else {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: response.message || "Something went wrong!",
                });
            }
        },

        error: function (err) {
            $(".btn").prop("disabled", false);
            console.error("Submission failed:", err);

            let message = "Something went wrong.";

            if (err.status === 422 && err.responseJSON?.errors) {
                const errors = err.responseJSON.errors;
                message = Object.values(errors).flat().join('\n');
            } else if (err.responseJSON?.message) {
                message = err.responseJSON.message;
            }

            Swal.fire({
                icon: "error",
                title: "Error",
                text: message,
            });
        }
    });
});








     // Status Update Toggle Button
    $(document).on("change", ".statusIdData", function () {
        let id = $(this).data("id");
        // console.log(id);
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
                    url: "/admin/itineraries/status/" + id,
                    success: function () {
                        // console.log(response);
                        checkbox.prop("disabled", false);
                        table.draw();
                    },
                    error: function (xhr) {
                        checkbox.prop("disabled", false);
                        console.log(xhr.responseJSON.message);
                    }
                })
            } else {
                checkbox.prop("disabled", false);
                checkbox.prop("checked", !checkbox.prop("checked"));
            }
        })

    })


    // Delete handler



       // Delete itinerary
  $(document).on("click", ".deleteItineraryBtn", function () {
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
                url: `/admin/itineraries/delete/${id}`,
                success: function () {
                    Swal.fire({
                        icon: "success",
                        title: "Deleted",
                        text: "Itinerary deleted successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if(itineraryTable){
        itineraryTable.ajax.reload(null, false);
    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to delete itinerary",
                    });
                }
            });
        }
    });
});



});
