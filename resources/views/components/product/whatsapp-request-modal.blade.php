@php
    $whatsappNumber = $contact ?? ($contact1 ?? ($contact2 ?? '9851065064'));
@endphp

<div
    class="modal fade"
    id="whatsappModal"
    tabindex="-1"
    aria-labelledby="whatsappModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            {{-- Modal Header --}}
            <div class="text-white modal-header bg-success">
                <h5
                    class="gap-2 modal-title d-flex align-items-center"
                    id="whatsappModalLabel"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        fill="currentColor"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
                        />
                    </svg>

                    Request Product
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>

            {{-- Form --}}
            <form id="whatsappForm">

                <div class="modal-body">

                    {{-- Product ID --}}
                    <input
                        type="hidden"
                        id="product_id"
                        name="product_id"
                    >

                    {{-- Product Code --}}
                    <input
                        type="hidden"
                        id="product_code"
                        name="product_code"
                    >

                    {{-- Product Preview --}}
                    <div class="mb-3 text-center">
                        <img
                            id="modal_product_image"
                            src=""
                            alt="Product"
                            class="rounded img-fluid"
                            style="max-height: 150px; object-fit: contain;"
                        >
                    </div>

                    {{-- Product Information --}}
                    <div class="mb-3 row g-2">

                        {{-- Product Name --}}
                        <div class="col-12 col-sm-7">
                            <label
                                class="mb-1 form-label small text-muted"
                                for="product_name"
                            >
                                Product
                            </label>

                            <input
                                type="text"
                                id="product_name"
                                class="form-control form-control-sm bg-light"
                                readonly
                            >
                        </div>

                        {{-- Product Code --}}
                        <div class="col-12 col-sm-5">
                            <label
                                class="mb-1 form-label small text-muted"
                                for="product_code_display"
                            >
                                Product Code
                            </label>

                            <input
                                type="text"
                                id="product_code_display"
                                class="form-control form-control-sm bg-light"
                                readonly
                            >
                        </div>

                        {{-- Price --}}
                        <div class="col-12">
                            <label
                                class="mb-1 form-label small text-muted"
                                for="product_price"
                            >
                                Price
                            </label>

                            <input
                                type="text"
                                id="product_price"
                                class="form-control form-control-sm bg-light"
                                readonly
                            >
                        </div>

                    </div>

                    {{-- Quantity --}}
                    <div class="mb-3">
                        <label
                            class="mb-1 form-label small text-muted"
                            for="quantity"
                        >
                            Quantity
                        </label>

                        <input
                            type="number"
                            id="quantity"
                            class="form-control form-control-sm"
                            value="1"
                            min="1"
                        >
                    </div>

                    {{-- Intent Options --}}
                    <div class="p-3 mb-3 rounded bg-light">

                        <label class="mb-2 form-label fw-semibold small">
                            What do you want?
                        </label>

                        <div class="row g-2">

                            <div class="col-6">
                                <div class="mb-0 form-check">
                                    <input
                                        class="form-check-input intent-option"
                                        type="checkbox"
                                        id="intent_buy"
                                        value="I want to buy this product"
                                    >

                                    <label
                                        class="form-check-label small"
                                        for="intent_buy"
                                    >
                                        Buy Product
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-0 form-check">
                                    <input
                                        class="form-check-input intent-option"
                                        type="checkbox"
                                        id="intent_details"
                                        value="I want more details about this product"
                                    >

                                    <label
                                        class="form-check-label small"
                                        for="intent_details"
                                    >
                                        More Details
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-0 form-check">
                                    <input
                                        class="form-check-input intent-option"
                                        type="checkbox"
                                        id="intent_availability"
                                        value="Is this product available?"
                                    >

                                    <label
                                        class="form-check-label small"
                                        for="intent_availability"
                                    >
                                        Check Availability
                                    </label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-0 form-check">
                                    <input
                                        class="form-check-input intent-option"
                                        type="checkbox"
                                        id="intent_price"
                                        value="Can you give me best price?"
                                    >

                                    <label
                                        class="form-check-label small"
                                        for="intent_price"
                                    >
                                        Best Price
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Customer Name & Phone --}}
                    <div class="mb-2 row g-2">

                        <div class="col-12 col-sm-6">
                            <label
                                class="mb-1 form-label small text-muted"
                                for="name"
                            >
                                Your Name
                            </label>

                            <input
                                type="text"
                                id="name"
                                class="form-control form-control-sm"
                                required
                                placeholder="Full name"
                            >
                        </div>

                        <div class="col-12 col-sm-6">
                            <label
                                class="mb-1 form-label small text-muted"
                                for="phone"
                            >
                                Phone
                            </label>

                            <input
                                type="tel"
                                id="phone"
                                class="form-control form-control-sm"
                                required
                                placeholder="+977 ..."
                            >
                        </div>

                    </div>

                    {{-- Country --}}
                    <div class="mb-3">
                        <x-country-dropdown />
                    </div>

                    {{-- Custom Message --}}
                    <div class="mb-2">
                        <label
                            class="mb-1 form-label small text-muted"
                            for="message"
                        >
                            Custom Message
                        </label>

                        <textarea
                            id="message"
                            class="form-control form-control-sm"
                            rows="3"
                            placeholder="Optional..."
                        ></textarea>
                    </div>

                </div>

                {{-- reCAPTCHA --}}
                <input
                    type="hidden"
                    name="recaptcha_token"
                    id="recaptcha_token"
                >

                {{-- Footer --}}
                <div class="flex-wrap gap-2 modal-footer justify-content-between">

                    <button
                        type="button"
                        class="btn btn-sm btn-outline-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="gap-2 btn btn-sm btn-success d-flex align-items-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
                            />
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
                overflow-y: auto;
            }
        </style>
    @endpush
@endonce

@once
    @push('scripts')

        <script src="https://www.google.com/recaptcha/api.js?render={{ config('google_recaptcha.site_key') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                /*
                |--------------------------------------------------------------------------
                | WhatsApp Modal
                |--------------------------------------------------------------------------
                */

                const whatsappModalElement = document.getElementById('whatsappModal');

                const whatsappModal = new bootstrap.Modal(
                    whatsappModalElement
                );

                /*
                |--------------------------------------------------------------------------
                | Open Modal
                |--------------------------------------------------------------------------
                */

                document.querySelectorAll('.request-whatsapp').forEach(btn => {

                    btn.addEventListener('click', function () {

                        const productId = this.dataset.productId;
                        const productName = this.dataset.productName;
                        const productCode = this.dataset.productCode || '';
                        const productPrice = this.dataset.productPrice || '0';
                        const productImage = this.dataset.productImage;

                        /*
                        |--------------------------------------------------------------------------
                        | Set Product Data
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('product_id').value =
                            productId;

                        document.getElementById('product_code').value =
                            productCode;

                        document.getElementById('product_name').value =
                            productName;

                        document.getElementById('product_code_display').value =
                            productCode;

                        document.getElementById('product_price').value =
                            productPrice;

                        document.getElementById('modal_product_image').src =
                            productImage;

                        /*
                        |--------------------------------------------------------------------------
                        | Reset Request-Specific Fields
                        |--------------------------------------------------------------------------
                        */

                        document.getElementById('quantity').value = 1;

                        document.getElementById('message').value = '';

                        document.querySelectorAll('.intent-option').forEach(
                            checkbox => {
                                checkbox.checked = false;
                            }
                        );

                        /*
                        |--------------------------------------------------------------------------
                        | Show Modal
                        |--------------------------------------------------------------------------
                        */

                        whatsappModal.show();
                    });
                });

                /*
                |--------------------------------------------------------------------------
                | Form Submit
                |--------------------------------------------------------------------------
                */

                const whatsappForm = document.getElementById('whatsappForm');

                whatsappForm.addEventListener('submit', function (e) {

                    e.preventDefault();

                    grecaptcha.ready(function () {

                        grecaptcha.execute(
                            '{{ config('google_recaptcha.site_key') }}',
                            {
                                action: 'whatsapp_request'
                            }
                        ).then(function (token) {

                            /*
                            |--------------------------------------------------------------------------
                            | Verify reCAPTCHA
                            |--------------------------------------------------------------------------
                            */

                            fetch('/recaptcha/verify', {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },

                                body: JSON.stringify({
                                    token: token
                                })
                            })
                            .then(response => {

                                if (!response.ok) {
                                    throw new Error(
                                        'Verification failed'
                                    );
                                }

                                return response.json();
                            })
                            .then(data => {

                                if (!data.ok) {
                                    alert(
                                        'Bot detected. Please try again.'
                                    );

                                    return;
                                }

                                /*
                                |--------------------------------------------------------------------------
                                | Customer Data
                                |--------------------------------------------------------------------------
                                */

                                const name =
                                    document
                                        .getElementById('name')
                                        .value
                                        .trim();

                                const phone =
                                    document
                                        .getElementById('phone')
                                        .value
                                        .trim();

                                const message =
                                    document
                                        .getElementById('message')
                                        .value
                                        .trim();

                                /*
                                |--------------------------------------------------------------------------
                                | Product Data
                                |--------------------------------------------------------------------------
                                */

                                const productId =
                                    document
                                        .getElementById('product_id')
                                        .value;

                                const productName =
                                    document
                                        .getElementById('product_name')
                                        .value;

                                const productCode =
                                    document
                                        .getElementById('product_code')
                                        .value;

                                const productPrice =
                                    parseFloat(
                                        document
                                            .getElementById('product_price')
                                            .value
                                    ) || 0;

                                const quantity =
                                    parseInt(
                                        document
                                            .getElementById('quantity')
                                            .value
                                    ) || 1;

                                /*
                                |--------------------------------------------------------------------------
                                | Intent
                                |--------------------------------------------------------------------------
                                */

                                const intents = [
                                    ...document.querySelectorAll(
                                        '.intent-option:checked'
                                    )
                                ].map(
                                    checkbox => `• ${checkbox.value}`
                                );

                                /*
                                |--------------------------------------------------------------------------
                                | Total
                                |--------------------------------------------------------------------------
                                */

                                const total = (
                                    productPrice * quantity
                                ).toFixed(2);

                                /*
                                |--------------------------------------------------------------------------
                                | WhatsApp Message
                                |--------------------------------------------------------------------------
                                */

                                const fullMessage = `🛍️ *Product Inquiry*

👤 Name: ${name}
📞 Phone: ${phone}

📦 *Product:* ${productName}
🏷️ *Product Code:* ${productCode || 'N/A'}
💰 *Price:* ${productPrice}
🔢 *Quantity:* ${quantity}
💵 *Total:* ${total}

📌 *Request:*
${intents.length ? intents.join('\n') : 'No specific request'}

💬 *Message:*
${message || 'N/A'}

🔗 *Page:*
${window.location.href}`;

                                /*
                                |--------------------------------------------------------------------------
                                | Open WhatsApp
                                |--------------------------------------------------------------------------
                                */

                                window.open(
                                    `https://wa.me/{{ $whatsappNumber }}?text=${encodeURIComponent(fullMessage)}`,
                                    '_blank'
                                );

                                /*
                                |--------------------------------------------------------------------------
                                | Save Shipping/Product Request
                                |--------------------------------------------------------------------------
                                */

                                fetch(
                                    '{{ route('shipping-requests.store') }}',
                                    {
                                        method: 'POST',

                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },

                                        body: JSON.stringify({

                                            product_id: productId,

                                            product_code: productCode,

                                            customer_name: name,

                                            customer_phone: phone,

                                            message: message,

                                            quantity: quantity,

                                            product_name: productName,

                                            product_price: productPrice,

                                            total: total,

                                            intents: intents,

                                            page_url: window.location.href,

                                            recaptcha_token: token
                                        })
                                    }
                                )
                                .catch(error => {

                                    console.error(
                                        'Background save failed:',
                                        error
                                    );

                                });

                                /*
                                |--------------------------------------------------------------------------
                                | Close Modal
                                |--------------------------------------------------------------------------
                                */

                                whatsappModal.hide();

                                /*
                                |--------------------------------------------------------------------------
                                | Reset Form
                                |--------------------------------------------------------------------------
                                */

                                whatsappForm.reset();

                            })
                            .catch(error => {

                                console.error(error);

                                alert(
                                    'Verification failed. Please try again.'
                                );

                            });

                        });

                    });

                });

            });
        </script>

    @endpush
@endonce


