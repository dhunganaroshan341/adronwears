@if ($product['total_stock'] > 0)
    <a
        href="javascript:void(0);"
        class="btn btn-success btn-sm request-whatsapp"
        title="WhatsApp"
        data-product-id="{{ $product['id'] }}"
        data-product-name="{{ $product['name'] }}"
        data-product-code="{{ $product['product_code'] ?? '' }}"
        data-product-price="{{ $product['sale_price'] ?? $product['price'] }}"
        data-product-image="{{ asset($product['thumbnail'] ?? 'default-product.jpg') }}"
    >
        <i class="fab fa-whatsapp me-1"></i>
        <small>WhatsApp</small>
    </a>
@else
    <button
        type="button"
        class="px-2 py-1 btn btn-secondary btn-sm"
        disabled
        title="Out of Stock"
    >
        <i class="fas fa-times me-1"></i>
        <small>Out of Stock</small>
    </button>
@endif
