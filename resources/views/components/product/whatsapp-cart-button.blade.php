@if($product['total_stock'] > 0)
<a href="javascript:void(0);" class="btn btn-success btn-sm request-whatsapp" title="WhatsApp"
    data-product-id="{{ $product['id'] }}" data-product-name="{{ $product['name'] }}"
    data-product-price="{{ $product['sale_price'] ?? $product['price'] }}"
    data-product-image="{{ asset('storage/products/' . ($product['thumbnail'] ?? 'default-product.jpg')) }}">

    <i class="fab fa-whatsapp"></i>
    <small>WhatsApp</small>

</a>

<!-- <i class="fab fa-whatsapp me-1"></i> -->
</a>
@else
<button class="btn btn-secondary btn-sm px-2 py-1" disabled>
    <i class="fas fa-times me-1"></i>
    <small>Out of Stock</small>
</button>
@endif