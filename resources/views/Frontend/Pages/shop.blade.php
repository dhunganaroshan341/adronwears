@extends('Frontend.Layouts.main')

@section('content')

<div class="container py-5">
    <div class="row">
        <!-- Sidebar with Categories -->
        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>

            <!-- Search Filter -->
            <div class="mb-4">
                <input type="text" id="searchProducts" class="form-control" placeholder="Search products...">
            </div>

            <!-- Price Filter -->
            <div class="mb-4">
                <h5 class="fw-bold">Price Range</h5>
                <div class="row g-2">
                    <div class="col-6">
                        <input type="number" id="minPrice" class="form-control" placeholder="Min">
                    </div>
                    <div class="col-6">
                        <input type="number" id="maxPrice" class="form-control" placeholder="Max">
                    </div>
                    <div class="col-12 mt-2">
                        <button id="applyPriceFilter" class="btn btn-sm btn-success w-100">Apply Filter</button>
                    </div>
                </div>
            </div>

            <!-- Sort Options -->
            <div class="mb-4">
                <h5 class="fw-bold">Sort By</h5>
                <select id="sortProducts" class="form-select">
                    <option value="default">Default</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="name_asc">Name: A to Z</option>
                    <option value="name_desc">Name: Z to A</option>
                    <option value="newest">Newest First</option>
                </select>
            </div>

            <!-- Categories Accordion -->
            <ul class="list-unstyled templatemo-accordion">
                @foreach($categories as $parent)
                <li class="pb-2">
                    @if(count($parent['children']) > 0)
                    <!-- Parent with accordion -->
                    <a class="d-flex justify-content-between text-decoration-none" data-bs-toggle="collapse"
                        href="#cat-{{ $parent['id'] }}" role="button" aria-expanded="false">
                        <span>
                            {{ $parent['name'] }}
                            <small class="text-muted">({{ $parent['products_count'] ?? 0 }})</small>
                        </span>
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>

                    <!-- Children -->
                    <ul id="cat-{{ $parent['id'] }}" class="collapse list-unstyled ps-3 mt-2">
                        @foreach($parent['children'] as $child)
                        <li class="mb-2">
                            <a class="d-flex justify-content-between text-decoration-none category-filter" href="#"
                                data-category-id="{{ $child['id'] }}">
                                <span>{{ $child['name'] }}</span>
                                <small class="text-muted">({{ $child['products_count'] ?? 0 }})</small>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <!-- No children -->
                    <a class="d-flex justify-content-between text-decoration-none category-filter" href="#"
                        data-category-id="{{ $parent['id'] }}">
                        <span>{{ $parent['name'] }}</span>
                        <small class="text-muted">({{ $parent['products_count'] ?? 0 }})</small>
                    </a>
                    @endif
                </li>
                @endforeach
            </ul>

            <!-- Clear Filters Button -->
            <button id="clearFilters" class="btn btn-outline-secondary w-100 mt-4">
                <i class="fas fa-eraser"></i> Clear All Filters
            </button>
        </div>

        <!-- Products Grid -->
        <div class="col-lg-9">
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
                                <img src="{{ asset('storage/products/' . ($product['thumbnail'] ?? 'default-product.jpg')) }}"
                                    class="card-img-top" alt="{{ $product['name'] }}"
                                    style="height: 250px; object-fit: cover;">
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ $product['category']['name'] ?? 'Uncategorized'
                                    }}</span>
                                @if($product['brand'])
                                <span class="badge bg-light text-dark">{{ $product['brand'] }}</span>
                                @endif
                            </div>

                            <a href="{{ route('shop.product', $product['slug']) }}"
                                class="h5 text-decoration-none text-dark fw-bold">
                                {{ $product['name'] }}
                            </a>

                            <p class="card-text text-muted small mt-2">
                                {{ Str::limit($product['description'] ?? 'No description available', 60) }}
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

                                @if($product['total_stock'] > 0)
                                <button class="btn btn-sm btn-outline-success request-product"
                                    data-product-id="{{ $product['id'] }}">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                                @else
                                <button class="btn btn-sm btn-secondary" disabled>
                                    <i class="fas fa-times"></i> Out of Stock
                                </button>
                                @endif
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

    .request-product {
        transition: all 0.3s ease;
    }

    .request-product:hover {
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
    }
</style>
@endpush

@push('scripts')
<script>
    // Global variables
    let currentCategory = null;
    let currentMinPrice = null;
    let currentMaxPrice = null;
    let currentSort = 'default';
    let currentSearch = '';

    // Filter products (client-side filtering)
    function filterProducts() {
        const products = document.querySelectorAll('.product-item');
        let visibleCount = 0;

        products.forEach(product => {
            let show = true;

            // Category filter
            if (currentCategory) {
                const productCategory = product.dataset.productCategory;
                if (productCategory != currentCategory) {
                    show = false;
                }
            }

            // Price filter
            if (show && (currentMinPrice || currentMaxPrice)) {
                const price = parseFloat(product.dataset.productPrice);
                if (currentMinPrice && price < currentMinPrice) show = false;
                if (currentMaxPrice && price > currentMaxPrice) show = false;
            }

            // Search filter
            if (show && currentSearch) {
                const productName = product.dataset.productName.toLowerCase();
                if (!productName.includes(currentSearch.toLowerCase())) {
                    show = false;
                }
            }

            product.style.display = show ? 'block' : 'none';
            if (show) visibleCount++;
        });

        // Update product count
        document.getElementById('productCount').textContent = visibleCount;

        // Sort products
        if (currentSort !== 'default') {
            sortProducts();
        }
    }

    // Sort products
    function sortProducts() {
        const grid = document.getElementById('productsGrid');
        const products = Array.from(document.querySelectorAll('.product-item'));

        products.sort((a, b) => {
            const aName = a.dataset.productName;
            const bName = b.dataset.productName;
            const aPrice = parseFloat(a.dataset.productPrice);
            const bPrice = parseFloat(b.dataset.productPrice);

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
                    // Assuming newer products have higher IDs
                    return parseInt(b.dataset.productId) - parseInt(a.dataset.productId);
                default:
                    return 0;
            }
        });

        // Reorder DOM elements
        products.forEach(product => {
            grid.appendChild(product);
        });
    }

    // Category filter click handlers
    document.querySelectorAll('.category-filter').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();

            // Toggle active class
            document.querySelectorAll('.category-filter').forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Set filter
            currentCategory = this.dataset.categoryId;
            filterProducts();
        });
    });

    // Price filter
    document.getElementById('applyPriceFilter')?.addEventListener('click', function () {
        currentMinPrice = parseFloat(document.getElementById('minPrice').value) || null;
        currentMaxPrice = parseFloat(document.getElementById('maxPrice').value) || null;
        filterProducts();
    });

    // Search filter
    document.getElementById('searchProducts')?.addEventListener('keyup', function () {
        currentSearch = this.value;
        filterProducts();
    });

    // Sort products
    document.getElementById('sortProducts')?.addEventListener('change', function () {
        currentSort = this.value;
        filterProducts();
    });

    // Clear all filters
    document.getElementById('clearFilters')?.addEventListener('click', function () {
        // Reset all filter variables
        currentCategory = null;
        currentMinPrice = null;
        currentMaxPrice = null;
        currentSearch = '';
        currentSort = 'default';

        // Reset UI elements
        document.getElementById('minPrice').value = '';
        document.getElementById('maxPrice').value = '';
        document.getElementById('searchProducts').value = '';
        document.getElementById('sortProducts').value = 'default';
        document.querySelectorAll('.category-filter').forEach(l => l.classList.remove('active'));

        // Reset product display
        filterProducts();

        // Show success message
        showToast('All filters cleared!', 'info');
    });

    // Quick add to cart
    document.querySelectorAll('.request-product').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const productId = this.dataset.productId;

            // Save original button state
            const originalHTML = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;

            // Simulate add to cart (replace with actual AJAX)
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-check"></i>';
                this.classList.remove('btn-outline-success');
                this.classList.add('btn-success');

                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    this.disabled = false;
                    this.classList.remove('btn-success');
                    this.classList.add('btn-outline-success');
                }, 2000);

                showToast('Product added to cart! 🛒');
            }, 500);
        });
    });

    // Toast notification
    function showToast(message, type = 'success') {
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '1050';
            document.body.appendChild(toastContainer);
        }

        const toastEl = document.createElement('div');
        toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
        toastEl.setAttribute('role', 'alert');

        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        toastContainer.appendChild(toastEl);
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();

        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }
</script>
@endpush