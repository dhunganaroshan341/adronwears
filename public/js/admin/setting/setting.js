$(document).ready(function () {
    $(".description").summernote({
        height: 300,
    });
   
    $('#multiple-days').select2({
        placeholder: "Please Select the days",
        allowClear: true
    });
   
     var table=$("#fetch-working-details").DataTable({
        processing:true,
        serverSide:true,
        searching:false,
        ordering:false,
        paging:false,
        info:false,
        ajax:"/admin/setting",
        columns:[
            {
                data:"days", name:"days"
            },{
                data:"starting_time", name:"starting_time"
            },{
                data:"ending_time", name:"ending_time"
            },{
                data:"action", name:"action"
            }
        ]
    })

    // Initialize selected days array
    let selectedDays = [];

    // Function to update dropdown options
    function updateDropdownOptions() {
        $(".multiple-days").each(function () {
            // Get the current select element
            const $select = $(this);

            // Get its selected values
            const currentSelection = $select.val() || [];

            // Reset its options
            $select.find("option").prop("disabled", false);

            // Disable already selected values
            selectedDays.forEach((day) => {
                if (!currentSelection.includes(day)) {
                    $select
                        .find(`option[value="${day}"]`)
                        .prop("disabled", true);
                }
            });

            // Refresh the Select2 dropdown (if applicable)
            if ($select.hasClass("select2-hidden-accessible")) {
                $select.select2();
            }
        });
    }

   

    $(".fetch-multiple-columns").on("click", ".removeColumnBtn", function () {
        const $row = $(this).closest(".fetchExtraColumn");

        // Get the selected values from the row being removed
        const removedValues = $row.find(".multiple-days").val() || [];

        // Remove the row
        $row.remove();

        // Update the selectedDays array
        selectedDays = selectedDays.filter(
            (day) => !removedValues.includes(day)
        );

        // Update the dropdown options
        updateDropdownOptions();
    });

      // Track changes in select elements
      $(".fetch-multiple-columns").on("change", ".multiple-days", function () {
        // Update the selectedDays array
        selectedDays = [];

        $(".multiple-days").each(function () {
            const values = $(this).val() || [];
            selectedDays = selectedDays.concat(values);
        });

        // Update the dropdown options
        updateDropdownOptions();
    });
    
    // Create Working 
    $(document).on("submit","#addWorkingForm",function(event){
        event.preventDefault();
        let formdata=new FormData(this);
        $(".addWorkingBtn").prop("disabled",true);
        $.ajax({
            url:"/admin/setting/working",
            type:"post",
            data:formdata,
            processData:false,
            contentType:false,
            success:function(){
                table.draw();
                $("#addWorkingForm").trigger("reset");
                $(".multiple-days").val([]).trigger("change");
            },
            error:function(xhr){
                // console.log(xhr);
                if(xhr.status == 422){
                    let error=xhr.responseJSON.errors;
                    $.each(error,function(data,message){
                        $("#"+data+"-error").text(message[0]);
                    })
                }
            },
            complete:function(){
                $(".addWorkingBtn").prop("disabled",false);
            }
        })
    })

   
    $(document).on("click",".deleteWorkingBtn",function(){
        let id=$(this).attr("data-id");
        Swal.fire({
            icon:"warning",
            title:"Are you Sure ?",
            text:"You,won't be able to revert this!",
            showCancelButton:true,
            confirmButtonColor:"#3085d3",
            confirmButtonText:"Yes,Delete it!",
            cancelButtonColor:"#d33"
        }).then((result)=>{
            if(result.isConfirmed){
                $.ajax({
                    type:"get",
                    url:"/admin/setting/working/"+id,
                    success:function(response){
                        if(response.success ==true ){
                            Swal.fire({
                                icon:"success",
                                title:"Success",
                                text:"Working Days Deleted",
                                showConfirmButton:false,
                                timer:1000,
                            });
                            table.draw();
                        }
                    },
                    error:function(xhr){
                        console.log(xhr);
                        Swal.fire({
                            icon:"warning",
                            title:"Warning",
                            text:"Something went wrong!",
                        });
                    }
                })
            }
        })
    })

});
