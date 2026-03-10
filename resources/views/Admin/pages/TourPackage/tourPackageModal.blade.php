<div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow">
            <form id="formId" class="form">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i> Create Tour Package
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body px-4 py-3" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                    <div class="row g-4">

                        <!-- Title -->
                        <div class="col-md-6">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="title">Total Price - $ <span class="text-danger"></span></label>
                            <input type="text" name="price" id="price" class="form-control" nullable>
                        </div>

                        <!-- Slug -->
                        <div class="col-md-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                placeholder="Auto-generated if blank">
                        </div>

                        <!-- Location -->
                        <div class="col-md-3">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" class="form-control"
                                placeholder="Location">
                        </div>

                        <!-- Country -->
                        <div class="col-md-6">
                            <label for="our_country_id">Country <span class="text-danger">*</span></label>
                            <select name="our_country_id" id="our_country_id" class="form-select" required>
                                <option value="">-- Select Country --</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- Package Type -->
                        <div class="col-md-6">
                            <label for="package_type">Package Type</label>
                            <select name="package_type" id="package_type" class="form-select">
                                <option value="trekking">Trekking</option>
                                <option value="tour">Tour</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <!-- Parent Package -->
                        <div class="col-md-6">
                            <label for="parent_id">Parent Package</label>
                            <select name="parent_id" id="parent_id" class="form-select">
                                <option value="">-- No Parent --</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Duration -->
                        <div class="col-md-6">
                            <label for="duration">Duration</label>
                            <input type="text" name="duration" id="duration" class="form-control"
                                placeholder="e.g., 12 Days">
                        </div>

                        <!-- Max People -->
                        <div class="col-md-6">
                            <label for="max_people">Max People</label>
                            <input type="number" name="max_people" id="max_people" class="form-control"
                                placeholder="e.g., 30">
                        </div>

                        <!-- Available Seats -->
                        <div class="col-md-6">
                            <label for="available_seat">Available Seats</label>
                            <input type="number" name="available_seat" id="available_seat" class="form-control"
                                placeholder="e.g., 15">
                        </div>

                        <!-- Difficulty -->
                        <div class="col-md-6">
                            <label for="difficulty">Difficulty</label>
                            <select name="difficulty" id="difficulty" class="form-select">
                                <option value="">-- Select --</option>
                                <option value="easy">Easy</option>
                                <option value="moderate">Moderate</option>
                                <option value="hard">Hard</option>
                            </select>
                        </div>

                        <!-- Max Elevation -->
                        <div class="col-md-6">
                            <label for="max_elevation">Max Elevation (m)</label>
                            <input type="number" name="max_elevation" id="max_elevation" class="form-control">
                        </div>

                        <!-- Best Season -->
                        <div class="col-md-6">
                            <label for="best_season">Best Season</label>
                            <input type="text" name="best_season" id="best_season" class="form-control"
                                placeholder="e.g., March-May">
                        </div>

                        <!-- Start Point -->
                        <div class="col-md-6">
                            <label for="start_point">Start Point</label>
                            <input type="text" name="start_point" id="start_point" class="form-control">
                        </div>

                        <!-- End Point -->
                        <div class="col-md-6">
                            <label for="end_point">End Point</label>
                            <input type="text" name="end_point" id="end_point" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="pickup">Pickup Location</label>
                            <input type="text" class="form-control" name="pickup" id="pickup"
                                aria-describedby="helpId" placeholder="" value="TIA,Kathmandu">

                        </div>
                        <div class="col-md-6">
                            <label for="drop">Drop Location</label>
                            <input type="text" class="form-control" name="drop" id="drop"
                                aria-describedby="helpId" placeholder="" value="TIA,Kathmandu">

                        </div>

                        <!-- Tour Package Tags -->
                        <div class="col-12">
                            <label class="form-label">Tour Package Tags</label>
                            <div class="row">

                                <!-- Top Deal -->
                                <div class="col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <input type="hidden" name="top_deal" value="0">
                                            <input type="checkbox" id="top_deal" name="top_deal" value="1"
                                                class="form-check-input">
                                        </div>
                                        <div class="col-10">
                                            <label class="form-check-label" for="top_deal">Top Deal</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Favourite Destination -->
                                <div class="col-md-6">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <input type="hidden" name="favourite_destination" value="0">
                                            <input type="checkbox" id="favourite_destination"
                                                name="favourite_destination" value="1" class="form-check-input">
                                        </div>
                                        <div class="col-10">
                                            <label class="form-check-label" for="favourite_destination">Favourite
                                                Destination</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Accomodation -->
                        <div class="col-12">
                            <label for="accomodation">Accomodation</label>
                            <textarea name="accomodation" id="accomodation" rows="3" class="form-control" style="height: 20px;"></textarea>
                        </div>

                        <!-- Short Description -->
                        <div class="col-12">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" id="short_description" rows="5" class="form-control"
                                style="height: 20px;"></textarea>
                        </div>

                        <!-- What to Expect -->
                        <div class="col-12">
                            <label for="what_to_expect" class="form-label">What To Expect</label>
                            <textarea class="form-control summernote" id="what_to_expect" name="what_to_expect" rows="5"
                                style="min-height: 250px;"></textarea>
                        </div>

                        <!-- Long Description -->
                        <div class="col-12">
                            <label for="long_description" class="form-label">Description</label>
                            <textarea class="form-control summernote" id="long_description" name="long_description" rows="5"
                                style="min-height: 250px;"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="price_includes" class="form-label">Package Includes</label>
                            <textarea class="form-control summernote" id="price_includes" name="price_includes" rows="5"
                                style="min-height: 250px;"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="price_excludes" class="form-label">Package Excludes</label>
                            <textarea class="form-control summernote" id="price_excludes" name="price_excludes" rows="5"
                                style="min-height: 250px;"></textarea>
                        </div>


                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer px-4 py-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submitBtn" data-action="">Submit</button>
                    <button type="submit" class="btn btn-success updateBtn" data-action="edit">Update
                        Package</button>
                </div>
            </form>
        </div>
    </div>
</div>
