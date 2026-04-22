<div class="modal fade" id="whatsappModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Request Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="whatsappForm">
                <div class="modal-body">

                    <!-- Product Preview -->
                    <div class="text-center mb-3">
                        <img id="modal_product_image" src="" class="img-fluid rounded" style="max-height:150px;">
                    </div>

                    <div class="mb-2">
                        <label>Product</label>
                        <input type="text" id="product_name" class="form-control" readonly>
                    </div>

                    <div class="mb-2">
                        <label>Price</label>
                        <input type="text" id="product_price" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label>Quantity</label>
                        <input type="number" id="quantity" class="form-control" value="1" min="1">
                    </div>

                    <!-- Intent Options -->
                    <div class="mb-3">
                        <label class="fw-bold">What do you want?</label>

                        <div class="form-check">
                            <input class="form-check-input intent-option" type="checkbox"
                                value="I want to buy this product">
                            <label class="form-check-label">Buy Product</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input intent-option" type="checkbox"
                                value="I want more details about this product">
                            <label class="form-check-label">More Details</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input intent-option" type="checkbox"
                                value="Is this product available?">
                            <label class="form-check-label">Check Availability</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input intent-option" type="checkbox"
                                value="Can you give me best price?">
                            <label class="form-check-label">Best Price</label>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="mb-3">
                        <label>Your Name</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3 ">
                        <x-country-dropdown />
                    </div>

                    <div class="mb-3 ">
                        <label>Phone</label>
                        <input type="text" id="phone" class="form-control" required>
                    </div>

                    <!-- Custom Message -->
                    <div class="mb-3">
                        <label>Custom Message</label>
                        <textarea id="message" class="form-control" placeholder="Optional..."></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Send to WhatsApp
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@once
@push('scripts')
<script>
    // Open modal and inject product data
    document.querySelectorAll('.request-product').forEach(btn => {
        btn.addEventListener('click', function () {

            document.getElementById('product_name').value = this.dataset.productName;
            document.getElementById('product_price').value = this.dataset.productPrice;
            document.getElementById('modal_product_image').src = this.dataset.productImage;

            let modal = new bootstrap.Modal(document.getElementById('whatsappModal'));
            modal.show();
        });
    });

    // Handle form submit
    document.getElementById('whatsappForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let name = document.getElementById('name').value;
        let phone = document.getElementById('phone').value;
        let message = document.getElementById('message').value;

        let productName = document.getElementById('product_name').value;
        let productPrice = document.getElementById('product_price').value;
        let quantity = document.getElementById('quantity').value;

        // Collect selected intents
        let intents = [];
        document.querySelectorAll('.intent-option:checked').forEach(cb => {
            intents.push(cb.value);
        });

        let total = (productPrice * quantity).toFixed(2);

        let fullMessage =
            `🛍️ *Product Inquiry*

👤 Name: ${name}
📞 Phone: ${phone}

📦 Product: ${productName}
💰 Price: ${productPrice}
🔢 Quantity: ${quantity}
💵 Total: ${total}

📌 Request:
${intents.length ? intents.join('\n') : 'No specific request'}

💬 Message:
${message || 'N/A'}

🔗 Page:
${window.location.href}`;

        let url = `https://wa.me/9779825056528?text=${encodeURIComponent(fullMessage)}`;

        window.open(url, '_blank');
    });
</script>
@endpush
@endOnce