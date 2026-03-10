<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formId" class="form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="homeSlideTitle">Edit Testimonial</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="validationErrors" class="alert alert-danger d-none"></p>
                    <div class="row">
                        <span class="mt-2 mb-4"><span class="text-danger">Note:</span> (<span class="text-danger">*</span>) symbol represent that the field is required</span>
                       
                        <div class="form-group col-md-4">
                            <label for="days">DaysDays<span class="text-danger">*</span></label>
                            <select id="select-multiple-days-edit" class="form-control multiple-days" multiple>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thrusday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                            </select>
                            <p id="days-error" class="text-danger workingHourEditAlert"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Starting Time<span class="text-danger">*</span></label>
                            <input type="time" name="starting_time" id="starting_time" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                                <p id="starting_time-error" class="text-danger workingHourEditAlert"></p>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Ending Time<span class="text-danger">*</span></label>
                            <input type="time" name="ending_time" id="ending_time" class="form-control" placeholder=""
                                aria-describedby="helpId" />
                                <p id="ending_time-error" class="text-danger workingHourEditAlert"></p>
                        </div>
                       
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update
                        Working Hour</button>
                </div>
            </form>
        </div>
    </div>
</div>
