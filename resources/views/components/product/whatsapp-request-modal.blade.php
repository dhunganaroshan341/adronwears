<div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-success text-white">
                <h5 class="modal-title d-flex align-items-center gap-2" id="whatsappModalLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                    Request Product
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form id="whatsappForm">
                <div class="modal-body">

                    {{-- Product Preview --}}
                    <div class="text-center mb-3">
                        <img id="modal_product_image" src="" alt="Product" class="img-fluid rounded"
                            style="max-height: 150px; object-fit: contain;">
                    </div>

                    {{-- Product & Price --}}
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-7">
                            <label class="form-label small text-muted mb-1">Product</label>
                            <input type="text" id="product_name" class="form-control form-control-sm bg-light" readonly>
                        </div>
                        <div class="col-12 col-sm-5">
                            <label class="form-label small text-muted mb-1">Price</label>
                            <input type="text" id="product_price" class="form-control form-control-sm bg-light"
                                readonly>
                        </div>
                    </div>

                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label class="form-label small text-muted mb-1" for="quantity">Quantity</label>
                        <input type="number" id="quantity" class="form-control form-control-sm" value="1" min="1">
                    </div>

                    {{-- Intent Options --}}
                    <div class="mb-3 p-3 bg-light rounded">
                        <label class="form-label fw-semibold small mb-2">What do you want?</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="form-check mb-0">
                                    <input class="form-check-input intent-option" type="checkbox" id="intent_buy"
                                        value="I want to buy this product">
                                    <label class="form-check-label small" for="intent_buy">Buy Product</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mb-0">
                                    <input class="form-check-input intent-option" type="checkbox" id="intent_details"
                                        value="I want more details about this product">
                                    <label class="form-check-label small" for="intent_details">More Details</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mb-0">
                                    <input class="form-check-input intent-option" type="checkbox"
                                        id="intent_availability" value="Is this product available?">
                                    <label class="form-check-label small" for="intent_availability">Check
                                        Availability</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mb-0">
                                    <input class="form-check-input intent-option" type="checkbox" id="intent_price"
                                        value="Can you give me best price?">
                                    <label class="form-check-label small" for="intent_price">Best Price</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Name & Phone --}}
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label class="form-label small text-muted mb-1" for="name">Your Name</label>
                            <input type="text" id="name" class="form-control form-control-sm" required
                                placeholder="Full name">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="form-label small text-muted mb-1" for="phone">Phone</label>
                            <input type="tel" id="phone" class="form-control form-control-sm" required
                                placeholder="+977 ...">
                        </div>
                    </div>

                    {{-- Country Dropdown --}}
                    <div class="mb-3">
                        <x-country-dropdown />
                    </div>

                    {{-- Custom Message --}}
                    <div class="mb-2">
                        <label class="form-label small text-muted mb-1" for="message">Custom Message</label>
                        <textarea id="message" class="form-control form-control-sm" rows="3"
                            placeholder="Optional..."></textarea>
                    </div>

                </div>

                <div class="modal-footer justify-content-between flex-wrap gap-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-sm btn-success d-flex align-items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                        Send to WhatsApp
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@once
@push('styles')
<style>
    .modal-dialog-scrollable .modal-body {
        max-height: calc(100vh - 200px);
        /* critical */
        overflow-y: auto;
    }
</style>
@endpush
@endOnce
@once
@push('scripts')
<script>
    document.querySelectorAll('.request-whatsapp').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('product_name').value = this.dataset.productName;
            document.getElementById('product_price').value = this.dataset.productPrice;
            document.getElementById('modal_product_image').src = this.dataset.productImage;
            new bootstrap.Modal(document.getElementById('whatsappModal')).show();
        });
    });

    document.getElementById('whatsappForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const message = document.getElementById('message').value.trim();
        const productName = document.getElementById('product_name').value;
        const productPrice = parseFloat(document.getElementById('product_price').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 1;

        const intents = [...document.querySelectorAll('.intent-option:checked')]
            .map(cb => `• ${cb.value}`);

        const total = (productPrice * quantity).toFixed(2);

        const fullMessage =
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

        window.open(`https://wa.me/9779825056528?text=${encodeURIComponent(fullMessage)}`, '_blank');
    });
</script>
@endpush
@endOnce