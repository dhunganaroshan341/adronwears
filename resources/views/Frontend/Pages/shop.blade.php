@extends('Frontend.Layouts.main')

@section('content')

<div class="container py-5">
    <div class="row">
        <!-- Sidebar with Categories -->
        @include('components.shop.sidebar-filter', ['categories' => $categories])

        <!-- Products Grid -->
        <div class="col-lg-9 col-md-8">
            <!-- Page Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h1 class="h2">All Products</h1>
                        <div class="text-muted">
                            Showing <span id="productCount">{{ count($products) }}</span> products
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

            <!-- Products Loading Spinner -->
            <div id="loadingSpinner" class="text-center py-5" style="display: none;">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row" id="productsGrid">
                @forelse($products as $product)
                <div class="col-12 col-md-6 col-lg-4 mb-4 product-item" data-product-id="{{ $product['id'] }}"
                    data-product-name="{{ $product['name'] }}"
                    data-product-price="{{ $product['sale_price'] ?? $product['price'] }}"
                    data-product-category="{{ $product['category']['id'] ?? '' }}">
                    <div class="card h-100 shadow-sm product-card">
                        <!-- Product Badges -->
                        <div class="position-relative">
                            @if($product['is_new'])
                            <span class="badge bg-info position-absolute top-0 start-0 m-2 px-3 py-2">NEW</span>
                            @endif
                            @if($product['is_on_sale'] && $product['sale_price'])
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2 px-3 py-2">SALE</span>
                            @endif
                            <a href="{{ route('shop.product', $product['slug']) }}">
                                <img src="{{ $product['thumbnail'] ?? asset('default-product.jpg') }}"
                                    class="card-img-top" alt="{{ $product['name'] }}"
                                    style="height: 250px; object-fit: cover;">
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ $product['category']['name'] ?? 'Uncategorized'
                                    }}</span>
                                @if($product['brand'])
                                <span class="badge bg-light text-dark">{{ $product['brand']['name'] }}</span>
                                @endif
                            </div>

                            <a href="{{ route('shop.product', $product['slug']) }}"
                                class="h5 text-decoration-none text-dark fw-bold">
                                {{ $product['name'] }}
                            </a>

                            <p class="card-text text-muted small mt-2">
                                {!! Str::limit($product['description'] ?? 'No description available', 60) !!}
                            </p>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    @if($product['sale_price'] && $product['sale_price'] < $product['price']) <span
                                        class="text-danger fw-bold h5">${{ number_format($product['sale_price'], 2)
                                        }}</span>
                                        <span class="text-muted text-decoration-line-through ms-2 small">${{
                                            number_format($product['price'], 2) }}</span>
                                        @else
                                        <span class="text-success fw-bold h5">${{ number_format($product['price'], 2)
                                            }}</span>
                                        @endif
                                </div>

                                @include('components.product.whatsapp-cart-button', ['product' => $product])
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> No products found.
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($products) && method_exists($products, 'links'))
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<x-product.whatsapp-request-modal />
<!-- Brands Section -->
<section class="bg-light py-5 mt-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Top Brands</h1>
                <p>Shop from the world's most trusted brands</p>
            </div>
        </div>
        <div class="row d-flex flex-row align-items-center justify-content-center">
            @php
            $brandLogos = ['brand_01.png', 'brand_02.png', 'brand_03.png', 'brand_04.png', 'brand_05.png',
            'brand_06.png'];
            @endphp
            @foreach($brandLogos as $logo)
            <div class="col-6 col-md-3 col-lg-2 p-3 text-center">
                <a href="#">
                    <img class="img-fluid" src="{{ asset('assets/img/' . $logo) }}" alt="Brand Logo"
                        style="max-height: 60px; opacity: 0.7; transition: opacity 0.3s;">
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .product-card {
        transition: all 0.3s ease-in-out;
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .product-card .card-img-top {
        transition: transform 0.3s ease;
    }

    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }

    .category-filter {
        transition: all 0.3s ease;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .category-filter:hover {
        background-color: #f8f9fa;
        color: #28a745 !important;
        padding-left: 15px;
    }

    .category-filter.active {
        color: #28a745 !important;
        font-weight: bold;
        background-color: #e8f5e9;
    }

    .templatemo-accordion a {
        color: #212529;
    }

    .templatemo-accordion a:hover {
        color: #28a745;
    }

    /* .templatemo-accordion .collapse {
        display: none;
    } */

    /* .templatemo-accordion .collapse.show {
        display: block;
    } */

    .templatemo-accordion li {
        position: relative;
    }

    .add-to-cart {
        transition: all 0.3s ease;
    }

    .add-to-cart:hover {
        transform: scale(1.1);
    }

    /* Loading animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-item {
        animation: fadeIn 0.5s ease-out;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .product-card .card-img-top {
            height: 200px !important;
        }

        .templatemo-accordion a {
            font-size: 0.95rem;
            padding: 8px 0;
        }

        .templatemo-accordion small {
            font-size: 0.8rem;
        }

        .templatemo-accordion .fa-chevron-circle-down {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .templatemo-accordion a {
            font-size: 0.9rem;
        }

        .templatemo-accordion small {
            font-size: 0.75rem;
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

                const category =
                    product.dataset.productCategory ||
                    product.dataset.category;

                const price = parseFloat(
                    product.dataset.productPrice ||
                    product.dataset.price ||
                    0
                );

                const name =
                    (
                        product.dataset.productName ||
                        product.dataset.name ||
                        ''
                    ).toLowerCase();

                // Category
                if (currentCategory) {
                    if (String(category) !== String(currentCategory)) {
                        show = false;
                    }
                }

                // Price
                if (show && currentMinPrice !== null && price < currentMinPrice) {
                    show = false;
                }

                if (show && currentMaxPrice !== null && price > currentMaxPrice) {
                    show = false;
                }

                // Search
                if (show && currentSearch) {
                    if (!name.includes(currentSearch.toLowerCase())) {
                        show = false;
                    }
                }

                product.style.display = show ? '' : 'none';

                if (show) {
                    visibleCount++;
                }
            });

            const countEl = document.getElementById('productCount');

            if (countEl) {
                countEl.textContent = visibleCount;
            }

            if (currentSort !== 'default') {
                sortProducts();
            }
        }

        function sortProducts() {

            const grid = document.getElementById('productsGrid');

            if (!grid) return;

            const products = Array.from(
                document.querySelectorAll('.product-item')
            );

            products.sort((a, b) => {

                const aName =
                    a.dataset.productName ||
                    a.dataset.name ||
                    '';

                const bName =
                    b.dataset.productName ||
                    b.dataset.name ||
                    '';

                const aPrice = parseFloat(
                    a.dataset.productPrice ||
                    a.dataset.price ||
                    0
                );

                const bPrice = parseFloat(
                    b.dataset.productPrice ||
                    b.dataset.price ||
                    0
                );

                const aId = parseInt(
                    a.dataset.productId ||
                    a.dataset.id ||
                    0
                );

                const bId = parseInt(
                    b.dataset.productId ||
                    b.dataset.id ||
                    0
                );

                switch (currentSort) {

                    case 'price_asc':
                        return aPrice - bPrice;

                    case 'price_desc':
                        return bPrice - aPrice;

                    case 'name_asc':
                        return aName.localeCompare(bName);

                    case 'name_desc':
                        return bName.localeCompare(aName);

                    case 'newest':
                        return bId - aId;

                    default:
                        return 0;
                }
            });

            products.forEach(product => {
                grid.appendChild(product);
            });
        }

        // CATEGORY
        document.querySelectorAll('.category-filter')
            .forEach(link => {

                link.addEventListener('click', function (e) {

                    e.preventDefault();

                    document.querySelectorAll('.category-filter')
                        .forEach(item => item.classList.remove('active'));

                    this.classList.add('active');

                    currentCategory =
                        this.dataset.category ||
                        this.dataset.categoryId;

                    filterProducts();
                });
            });

        // PRICE
        document.getElementById('applyPriceFilter')
            ?.addEventListener('click', function () {

                currentMinPrice =
                    parseFloat(document.getElementById('minPrice').value) || null;

                currentMaxPrice =
                    parseFloat(document.getElementById('maxPrice').value) || null;

                filterProducts();
            });

        // SEARCH
        document.getElementById('searchProducts')
            ?.addEventListener('input', function () {

                currentSearch = this.value.trim();

                filterProducts();
            });

        // SORT
        document.getElementById('sortProducts')
            ?.addEventListener('change', function () {

                currentSort = this.value;

                filterProducts();
            });

        // CLEAR
        document.getElementById('clearFilters')
            ?.addEventListener('click', function () {

                currentCategory = null;
                currentMinPrice = null;
                currentMaxPrice = null;
                currentSearch = '';
                currentSort = 'default';

                document.getElementById('minPrice').value = '';
                document.getElementById('maxPrice').value = '';

                document.getElementById('searchProducts').value = '';

                document.getElementById('sortProducts').value = 'default';

                document.querySelectorAll('.category-filter')
                    .forEach(item => item.classList.remove('active'));

                filterProducts();
            });

    });
</script>
@endpush