<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal">
    <i class="flaticon-building"></i> Book Now<i class="flaticon-arrow">
</button>




<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="#">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Full Name</label>
                                <input name="full_name" placeholder="Your Full Name" type="text" required
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input name="email" placeholder="Email Address" type="email" required
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Phone</label>
                                <input name="phone" placeholder="Phone Number" type="text" required
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Nationality</label>
                                <select name="nationality" class="niceSelect form-control" required>
                                    <option value="">Select Nationality</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Thailand">Thailand</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Adults</label>
                                <input name="adults" type="number" min="1" value="2" class="form-control"
                                    required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Children</label>
                                <input name="children" type="number" min="0" value="0"
                                    class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Destination</label>
                                <select name="destination" id="modal-destination-select" class="form-control" required>
                                    <option value="">Select Destination</option>
                                    <option value="Pokhara">Pokhara</option>
                                    <option value="Lumbini">Lumbini</option>
                                    <option value="Chitwan">Chitwan</option>
                                    <option value="Everest Base Camp">Everest Base Camp</option>
                                    <option value="Rara Lake">Rara Lake</option>
                                    <option value="Mustang">Mustang</option>
                                    <option value="Kathmandu">Kathmandu</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Additional Message (Optional)</label>
                                <textarea name="message" rows="4" class="form-control" placeholder="Any message or request..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label>Total Price</label>
                                <input type="text" name="total_price" class="form-control"
                                    placeholder="Total will be calculated..." readonly />
                            </div>
                        </div>

                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Submit Booking</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
