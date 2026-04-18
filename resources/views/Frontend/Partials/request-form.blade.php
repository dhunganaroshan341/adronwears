<!-- Product Request Modal -->
<div class="modal fade" id="productRequestModal" tabindex="-1" aria-labelledby="productRequestModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="productRequestModalLabel">
                    Request Product - Adron Fashion Wear
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('product.request') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="row">

                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <!-- Location -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location *</label>
                            <input type="text" name="location" class="form-control" placeholder="City / Country"
                                required>
                        </div>

                        <!-- Product Name -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name *</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Quantity *</label>
                            <input type="number" name="quantity" class="form-control" min="1" required>
                        </div>

                        <!-- Size -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Size</label>
                            <select name="size" class="form-select">
                                <option value="">Select Size</option>
                                <option value="S">Small (S)</option>
                                <option value="M">Medium (M)</option>
                                <option value="L">Large (L)</option>
                                <option value="XL">Extra Large (XL)</option>
                                <option value="XXL">XXL</option>
                            </select>
                        </div>

                        <!-- Additional Message -->
                        <div class="col-12 mb-3">
                            <label class="form-label">Additional Notes</label>
                            <textarea name="message" rows="3" class="form-control"
                                placeholder="Any specific requirement?"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-outline-success">
                        Submit Request
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>