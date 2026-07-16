@extends('Frontend.Layouts.main')

@section('content')

<div class="container-fluid px-3 px-md-5 py-4">
    <div class="row g-4">
        <!-- Sidebar -->
        <div class="col-lg-3 col-12">
            @include('components.shop.sidebar-filter', ['categories' => $categories])
        </div>

        <div class="col-lg-9 col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 shop-header">
                <div>
                    <h1 class="shop-title mb-0">Shop</h1>
                    <span class="text-muted small"><span id="productCount">{{ count($products) }}</span> items</span>
                </div>

                <!-- <div class="d-flex align-items-center gap-2">
                    <input type="text" id="searchProducts" class="form-control form-control-sm shop-input"
                        placeholder="Search..." style="width: 180px;">

                    <select id="sortProducts" class="form-select form-select-sm shop-input" style="width: 160px;">
                        <option value="default">Sort: Featured</option>
                        <option value="price_asc">Price: Low to High</option>
                        <option value="price_desc">Price: High to Low</option>
                        <option value="name_asc">Name: A-Z</option>
                        <option value="name_desc">Name: Z-A</option>
                        <option value="newest">Newest</option>
                    </select>
                </div> -->
            </div>

            <div id="loadingSpinner" class="text-center py-5" style="display: none;">
                <div class="spinner-border" style="color:#111;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Grid -->
            <div class="row g-3 g-md-4" id="productsGrid">
                @forelse($products as $product)
                <div class="col-6 col-md-4 col-xl-3 product-item" data-product-id="{{ $product['id'] }}"
                    data-product-name="{{ $product['name'] }}"
                    data-product-price="{{ $product['sale_price'] ?? $product['price'] }}"
                    data-product-category="{{ $product['category']['id'] ?? '' }}">
                    <div class="product-card">
                        <div class="product-media">
                            @if($product['is_new'])
                            <span class="tag tag-new">New</span>
                            @endif
                            @if($product['is_on_sale'] && $product['sale_price'])
                            <span class="tag tag-sale">Sale</span>
                            @endif
                            <a href="{{ route('shop.product', $product['slug']) }}">
                                <img src="{{ $product['thumbnail'] ?? asset('default-product.jpg') }}"
                                    alt="{{ $product['name'] }}" loading="lazy">
                            </a>
                        </div>

                        <div class="product-info">
                            <div class="product-meta">
                                <span>{{ $product['category']['name'] ?? 'Uncategorized' }}</span>
                                @if($product['brand'])
                                <span>· {{ $product['brand']['name'] }}</span>
                                @endif
                            </div>

                            <a href="{{ route('shop.product', $product['slug']) }}" class="product-name">
                                {{ $product['name'] }}
                            </a>

                            <div class="product-price">
                                @if($product['sale_price'] && $product['sale_price'] < $product['price']) <span
                                    class="price-now">${{ number_format($product['sale_price'], 2) }}</span>
                                    <span class="price-old">${{ number_format($product['price'], 2) }}</span>
                                    @else
                                    <span class="price-now">${{ number_format($product['price'], 2) }}</span>
                                    @endif
                            </div>

                            @include('components.product.whatsapp-cart-button', ['product' => $product])
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <p class="mb-0 text-muted">No products found.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($products) && method_exists($products, 'links'))
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<x-product.whatsapp-request-modal />

<!-- Brands -->
<section class="brands-section py-5 mt-4">
    <div class="container text-center">
        <h2 class="h4 mb-1">Top Brands</h2>
        <p class="text-muted small mb-4">Shop from the world's most trusted brands</p>
        <div class="row justify-content-center align-items-center g-4">
            @php
            $brandLogos = ['brand_01.png', 'brand_02.png', 'brand_03.png', 'brand_04.png', 'brand_05.png',
            'brand_06.png'];
            @endphp
            @foreach($brandLogos as $logo)
            <div class="col-4 col-md-2">
                <a href="#" class="brand-logo d-block">
                    <img class="img-fluid" src="{{ asset('assets/img/' . $logo) }}" alt="Brand Logo">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    :root {
        --ink: #111111;
        --muted: #767676;
        --line: #e7e7e7;
        --bg-soft: #f7f7f7;
        --sale: #c0392b;
    }

    body {
        color: var(--ink);
    }

    .shop-title {
        font-size: 1.9rem;
        font-weight: 600;
        letter-spacing: -0.02em;
    }

    .shop-input {
        border-color: var(--line);
        border-radius: 0;
    }

    .shop-input:focus {
        box-shadow: none;
        border-color: var(--ink);
    }

    /* Product card */
    .product-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .product-media {
        position: relative;
        aspect-ratio: 3 / 4;
        overflow: hidden;
        background: var(--bg-soft);
        margin-bottom: 0.75rem;
    }

    .product-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-media img {
        transform: scale(1.04);
    }

    .tag {
        position: absolute;
        top: 10px;
        font-size: 0.65rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        padding: 3px 8px;
        z-index: 2;
        font-weight: 600;
    }

    .tag-new {
        left: 10px;
        background: var(--ink);
        color: #fff;
    }

    .tag-sale {
        right: 10px;
        background: var(--sale);
        color: #fff;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .product-meta {
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        color: var(--muted);
    }

    .product-name {
        font-size: 0.92rem;
        font-weight: 500;
        color: var(--ink);
        text-decoration: none;
        line-height: 1.3;
        margin: 2px 0 6px;
    }

    .product-name:hover {
        text-decoration: underline;
    }

    .product-price {
        margin-bottom: 8px;
    }

    .price-now {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .price-old {
        color: var(--muted);
        text-decoration: line-through;
        font-size: 0.8rem;
        margin-left: 6px;
    }

    .empty-state {
        border: 1px dashed var(--line);
    }

    .brands-section {
        background: var(--bg-soft);
    }

    .brand-logo img {
        max-height: 40px;
        opacity: 0.55;
        filter: grayscale(100%);
        transition: opacity 0.25s ease, filter 0.25s ease;
    }

    .brand-logo:hover img {
        opacity: 1;
        filter: grayscale(0%);
    }

    .product-item {
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {
        .shop-title {
            font-size: 1.5rem;
        }

        .shop-header .form-control,
        .shop-header .form-select {
            width: 100% !important;
        }

        .shop-header {
            flex-direction: column;
            align-items: stretch !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        let currentCategory = null;
        let currentMinPrice = null;
        let currentMaxPrice = null;
        let currentSort = 'default';
        let currentSearch = '';

        function filterProducts() {
            const products = document.querySelectorAll('.product-item');
            let visibleCount = 0;

            products.forEach(product => {
                let show = true;

                const category = product.dataset.productCategory || product.dataset.category;
                const price = parseFloat(product.dataset.productPrice || product.dataset.price || 0);
                const name = (product.dataset.productName || product.dataset.name || '').toLowerCase();

                if (currentCategory && String(category) !== String(currentCategory)) show = false;
                if (show && currentMinPrice !== null && price < currentMinPrice) show = false;
                if (show && currentMaxPrice !== null && price > currentMaxPrice) show = false;
                if (show && currentSearch && !name.includes(currentSearch.toLowerCase())) show = false;

                product.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            const countEl = document.getElementById('productCount');
            if (countEl) countEl.textContent = visibleCount;

            if (currentSort !== 'default') sortProducts();
        }

        function sortProducts() {
            const grid = document.getElementById('productsGrid');
            if (!grid) return;

            const products = Array.from(document.querySelectorAll('.product-item'));

            products.sort((a, b) => {
                const aName = a.dataset.productName || a.dataset.name || '';
                const bName = b.dataset.productName || b.dataset.name || '';
                const aPrice = parseFloat(a.dataset.productPrice || a.dataset.price || 0);
                const bPrice = parseFloat(b.dataset.productPrice || b.dataset.price || 0);
                const aId = parseInt(a.dataset.productId || a.dataset.id || 0);
                const bId = parseInt(b.dataset.productId || b.dataset.id || 0);

                switch (currentSort) {
                    case 'price_asc': return aPrice - bPrice;
                    case 'price_desc': return bPrice - aPrice;
                    case 'name_asc': return aName.localeCompare(bName);
                    case 'name_desc': return bName.localeCompare(aName);
                    case 'newest': return bId - aId;
                    default: return 0;
                }
            });

            products.forEach(product => grid.appendChild(product));
        }

        document.querySelectorAll('.category-filter').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.category-filter').forEach(item => item.classList.remove('active'));
                this.classList.add('active');
                currentCategory = this.dataset.category || this.dataset.categoryId;
                filterProducts();
            });
        });

        document.getElementById('applyPriceFilter')?.addEventListener('click', function () {
            currentMinPrice = parseFloat(document.getElementById('minPrice').value) || null;
            currentMaxPrice = parseFloat(document.getElementById('maxPrice').value) || null;
            filterProducts();
        });

        document.getElementById('searchProducts')?.addEventListener('input', function () {
            currentSearch = this.value.trim();
            filterProducts();
        });

        document.getElementById('sortProducts')?.addEventListener('change', function () {
            currentSort = this.value;
            filterProducts();
        });

        document.getElementById('clearFilters')?.addEventListener('click', function () {
            currentCategory = null;
            currentMinPrice = null;
            currentMaxPrice = null;
            currentSearch = '';
            currentSort = 'default';

            const minEl = document.getElementById('minPrice');
            const maxEl = document.getElementById('maxPrice');
            const searchEl = document.getElementById('searchProducts');
            const sortEl = document.getElementById('sortProducts');

            if (minEl) minEl.value = '';
            if (maxEl) maxEl.value = '';
            if (searchEl) searchEl.value = '';
            if (sortEl) sortEl.value = 'default';

            document.querySelectorAll('.category-filter').forEach(item => item.classList.remove('active'));
            filterProducts();
        });

    });
</script>
@endpush