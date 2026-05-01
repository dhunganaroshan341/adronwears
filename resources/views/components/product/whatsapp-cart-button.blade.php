@if($product['total_stock'] > 0)
<a class="btn btn-sm btn-outline-success request-whatsapp" data-product-id="{{ $product['id'] }}"
    data-product-name="{{ $product['name'] }}" data-product-price="{{ $product['sale_price'] ?? $product['price'] }}"
    data-product-image="{{ asset('storage/products/' . ($product['thumbnail'] ?? 'default-product.jpg')) }}">
    <i class="fab fa-whatsapp me-1"></i> WhatsApp
</a>


<button class="btn btn-sm btn-outline-success add-to-cart" data-product-id="{{ $product['id'] }}">
    <i class="fas fa-cart-plus"></i>
</button>
@else
<button class="btn btn-sm btn-secondary" disabled>
    <i class="fas fa-times"></i> Out of Stock
</button>
@endif