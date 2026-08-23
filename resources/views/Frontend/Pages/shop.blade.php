@extends('Frontend.Layouts.main')

@section('content')

<div class="px-3 py-4 container-fluid shop-page px-md-5">

    <div class="row shop-layout">

        {{-- ========================================================= --}}
        {{-- SIDEBAR --}}
        {{-- ========================================================= --}}
        <aside class="col-12 col-lg-3 shop-sidebar">
            @include('components.shop.sidebar-filter', [
                'categories' => $categories
            ])
        </aside>


        {{-- ========================================================= --}}
        {{-- PRODUCTS --}}
        {{-- ========================================================= --}}
        <main class="col-12 col-lg-9 shop-content">

            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}
            <div class="mb-4 shop-header">

                <div>
                    <h1 class="mb-1 shop-title">
                        Shop
                    </h1>

                    <span class="shop-count text-muted small">
                        <span id="productCount">{{ $products->count() }}</span>
                        items
                    </span>
                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- LOADING --}}
            {{-- ===================================================== --}}
            <div id="loadingSpinner"
                 class="py-5 text-center loading-spinner"
                 style="display: none;">

                <div class="spinner-border"
                     role="status"
                     aria-label="Loading">
                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- PRODUCT GRID --}}
            {{-- ===================================================== --}}
            <div class="row products-grid" id="productsGrid">

                @forelse($products as $product)

                    <div
                        class="col-6 col-md-4 col-xl-3 product-item"
                        data-product-id="{{ $product['id'] }}"
                        data-product-name="{{ $product['name'] }}"
                        data-product-price="{{ $product['sale_price'] ?? $product['price'] }}"
                        data-product-category="{{ $product['category']['id'] ?? '' }}"
                    >

                        <article class="product-card">

                            {{-- ===================================== --}}
                            {{-- IMAGE --}}
                            {{-- ===================================== --}}
                            <div class="product-media">

                                {{-- New --}}
                                @if($product['is_new'])
                                    <span class="tag tag-new">
                                        New
                                    </span>
                                @endif

                                {{-- Sale --}}
                                @if(
                                    $product['is_on_sale'] &&
                                    !empty($product['sale_price']) &&
                                    $product['sale_price'] < $product['price']
                                )
                                    <span class="tag tag-sale">
                                        Sale
                                    </span>
                                @endif


                                <a
                                    href="{{ route('shop.product', $product['slug']) }}"
                                    class="product-image-link"
                                >
                                    <img
                                        src="{{ $product['thumbnail'] ?? asset('default-product.jpg') }}"
                                        alt="{{ $product['name'] }}"
                                        class="product-image"
                                        loading="lazy"
                                    >
                                </a>

                            </div>


                            {{-- ===================================== --}}
                            {{-- INFORMATION --}}
                            {{-- ===================================== --}}
                            <div class="product-info">

                                {{-- Category / Brand --}}
                                <div class="product-meta">

                                    <span>
                                        {{ $product['category']['name'] ?? 'Uncategorized' }}
                                    </span>

                                    @if(!empty($product['brand']))
                                        <span>
                                            · {{ $product['brand']['name'] }}
                                        </span>
                                    @endif

                                </div>


                              <a
    href="{{ route('shop.product', $product['slug']) }}"
    class="product-name d-block"
    title="{{ $product['name'] }}"
>
    <span class="d-block">
        {{ $product['name'] }}
    </span>

    @if (!empty($product['product_code']))
        <small class="mt-1 text-muted d-block">
            SKU: {{ $product['product_code'] }}
        </small>
    @endif
</a>


                                {{-- Price --}}
                                <div class="product-price">

                                    @if(
                                        !empty($product['sale_price']) &&
                                        $product['sale_price'] < $product['price']
                                    )

                                        <span class="price-now">
                                            ${{ number_format($product['sale_price'], 2) }}
                                        </span>

                                        <span class="price-old">
                                            ${{ number_format($product['price'], 2) }}
                                        </span>

                                    @else

                                        <span class="price-now">
                                            ${{ number_format($product['price'], 2) }}
                                        </span>

                                    @endif

                                </div>


                                {{-- WhatsApp --}}
                                @include(
                                    'components.product.whatsapp-cart-button',
                                    ['product' => $product]
                                )

                            </div>

                        </article>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="py-5 text-center empty-state">

                            <p class="mb-0 text-muted">
                                No products found.
                            </p>

                        </div>

                    </div>

                @endforelse

            </div>


            {{-- ===================================================== --}}
            {{-- PAGINATION --}}
            {{-- ===================================================== --}}
            @if(
                isset($products) &&
                method_exists($products, 'links')
            )

                <div class="mt-5 shop-pagination d-flex justify-content-center">
                    {{ $products->links() }}
                </div>

            @endif

        </main>

    </div>

</div>


{{-- ============================================================= --}}
{{-- WHATSAPP REQUEST MODAL --}}
{{-- ============================================================= --}}

<x-product.whatsapp-request-modal />


{{-- ============================================================= --}}
{{-- BRANDS --}}
{{-- ============================================================= --}}

<section class="py-5 mt-4 brands-section">

    <div class="container text-center">

        <h2 class="mb-1 h4">
            Top Brands
        </h2>

        <p class="mb-4 text-muted small">
            Shop from the world's most trusted brands
        </p>


        <div class="row justify-content-center align-items-center brands-grid">

            @php
                $brandLogos = [
                    'brand_01.png',
                    'brand_02.png',
                    'brand_03.png',
                    'brand_04.png',
                    // 'brand_05.png',
                    // 'brand_06.png',
                ];
            @endphp


            @foreach($brandLogos as $logo)

                <div class="col-4 col-md-2">

                    <a
                        href="#"
                        class="brand-logo d-flex justify-content-center align-items-center"
                    >

                        <img
                            src="{{ asset('assets/img/' . $logo) }}"
                            alt="Brand Logo"
                            loading="lazy"
                        >

                    </a>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection


{{-- ============================================================= --}}
{{-- STYLES --}}
{{-- ============================================================= --}}

@push('styles')

<style>

    :root {
        --ink: #111111;
        --muted: #767676;
        --line: #e7e7e7;
        --bg-soft: #f7f7f7;
        --sale: #c0392b;
    }


    /* =============================================================
       BASE
    ============================================================= */

    body {
        color: var(--ink);
    }


    .shop-page {
        width: 100%;
    }


    .shop-layout {
        --bs-gutter-x: 2rem;
        --bs-gutter-y: 2rem;
    }


    /* =============================================================
       HEADER
    ============================================================= */

    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }


    .shop-title {
        font-size: 1.9rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }


    .shop-count {
        font-size: 0.8rem;
    }


    /* =============================================================
       PRODUCT GRID
    ============================================================= */

    .products-grid {
        --bs-gutter-x: 1.25rem;
        --bs-gutter-y: 2rem;
    }


    .product-item {
        min-width: 0;
        animation: fadeIn 0.4s ease-out;
    }


    /* =============================================================
       PRODUCT CARD
    ============================================================= */

    .product-card {
        width: 100%;
        min-width: 0;
        height: 100%;

        display: flex;
        flex-direction: column;
    }


    /* =============================================================
       PRODUCT MEDIA
    ============================================================= */

    .product-media {
        position: relative;

        width: 100%;

        aspect-ratio: 3 / 4;

        overflow: hidden;

        background: var(--bg-soft);

        margin-bottom: 0.7rem;
    }


    .product-image-link {
        display: block;

        width: 100%;
        height: 100%;
    }


    .product-image {
        display: block;

        width: 100%;
        height: 100%;

        object-fit: cover;

        transition: transform 0.5s ease;
    }


    .product-card:hover .product-image {
        transform: scale(1.04);
    }


    /* =============================================================
       TAGS
    ============================================================= */

    .tag {
        position: absolute;

        top: 10px;

        z-index: 2;

        padding: 3px 8px;

        font-size: 0.65rem;
        font-weight: 600;

        letter-spacing: 0.05em;

        text-transform: uppercase;
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


    /* =============================================================
       PRODUCT INFO
    ============================================================= */

    .product-info {
        display: flex;
        flex-direction: column;

        min-width: 0;

        gap: 2px;
    }


    /* =============================================================
       CATEGORY / BRAND
    ============================================================= */

    .product-meta {
        min-width: 0;

        overflow: hidden;

        font-size: 0.7rem;

        line-height: 1.3;

        color: var(--muted);

        text-transform: uppercase;

        letter-spacing: 0.04em;

        white-space: nowrap;

        text-overflow: ellipsis;
    }


    /* =============================================================
       PRODUCT NAME
    ============================================================= */

    .product-name {
        display: -webkit-box;

        overflow: hidden;

        min-width: 0;

        margin: 2px 0 6px;

        color: var(--ink);

        font-size: 0.92rem;
        font-weight: 500;

        line-height: 1.3;

        text-decoration: none;

        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }


    .product-name:hover {
        text-decoration: underline;
    }


    /* =============================================================
       PRICE
    ============================================================= */

    .product-price {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 5px;

        margin-bottom: 8px;
    }


    .price-now {
        font-size: 0.95rem;
        font-weight: 600;
    }


    .price-old {
        color: var(--muted);

        font-size: 0.8rem;

        text-decoration: line-through;
    }


    /* =============================================================
       EMPTY STATE
    ============================================================= */

    .empty-state {
        border: 1px dashed var(--line);
    }


    /* =============================================================
       BRANDS
    ============================================================= */

    .brands-section {
        background: var(--bg-soft);
    }


    .brand-logo {
        min-height: 50px;
    }


    .brand-logo img {
        display: block;

        max-width: 100%;
        max-height: 40px;

        opacity: 0.55;

        filter: grayscale(100%);

        transition:
            opacity 0.25s ease,
            filter 0.25s ease;
    }


    .brand-logo:hover img {
        opacity: 1;
        filter: grayscale(0%);
    }


    /* =============================================================
       ANIMATION
    ============================================================= */

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


    /* =============================================================
       TABLET
    ============================================================= */

    @media (min-width: 768px) {

        .products-grid {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 2rem;
        }

    }


    /* =============================================================
       MOBILE
    ============================================================= */

    @media (max-width: 767.98px) {

        .shop-page {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }


        .shop-layout {
            --bs-gutter-x: 0;
            --bs-gutter-y: 1.5rem;
        }


        .shop-header {
            margin-bottom: 1.25rem !important;
        }


        .shop-title {
            font-size: 1.5rem;
        }


        /*
         * IMPORTANT:
         *
         * col-6 = exactly 2 products per row.
         *
         * We reduce the gutter so each card gets
         * enough horizontal space.
         */

        .products-grid {
            --bs-gutter-x: 10px;
            --bs-gutter-y: 24px;
        }


        /*
         * Slightly less tall images on mobile.
         *
         * 3/4 can feel too tall when the card is narrow.
         */

        .product-media {
            aspect-ratio: 4 / 5;
            margin-bottom: 0.55rem;
        }


        .tag {
            top: 7px;

            padding: 3px 6px;

            font-size: 0.58rem;
        }


        .tag-new {
            left: 7px;
        }


        .tag-sale {
            right: 7px;
        }


        .product-meta {
            font-size: 0.62rem;
        }


        .product-name {
            margin: 2px 0 5px;

            font-size: 0.82rem;

            line-height: 1.3;
        }


        .product-price {
            margin-bottom: 7px;
        }


        .price-now {
            font-size: 0.85rem;
        }


        .price-old {
            font-size: 0.7rem;
        }

    }


    /* =============================================================
       VERY SMALL PHONES
    ============================================================= */

    @media (max-width: 380px) {

        .products-grid {
            --bs-gutter-x: 8px;
            --bs-gutter-y: 20px;
        }


        .product-name {
            font-size: 0.78rem;
        }


        .product-meta {
            font-size: 0.58rem;
        }


        .price-now {
            font-size: 0.82rem;
        }

    }

</style>

@endpush


{{-- ============================================================= --}}
{{-- SCRIPTS --}}
{{-- ============================================================= --}}

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    let currentCategory = null;
    let currentMinPrice = null;
    let currentMaxPrice = null;
    let currentSort = 'default';
    let currentSearch = '';


    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const grid = document.getElementById('productsGrid');
    const countElement = document.getElementById('productCount');


    /*
    |--------------------------------------------------------------------------
    | Get Products
    |--------------------------------------------------------------------------
    */

    function getProducts() {

        if (!grid) {
            return [];
        }

        return Array.from(
            grid.querySelectorAll('.product-item')
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Filter Products
    |--------------------------------------------------------------------------
    */

    function filterProducts() {

        const products = getProducts();

        let visibleCount = 0;


        products.forEach(product => {

            const category =
                product.dataset.productCategory || '';

            const price =
                parseFloat(product.dataset.productPrice || 0);

            const name =
                (product.dataset.productName || '')
                    .toLowerCase();


            let visible = true;


            /*
            | Category
            */

            if (
                currentCategory !== null &&
                String(category) !== String(currentCategory)
            ) {
                visible = false;
            }


            /*
            | Minimum price
            */

            if (
                visible &&
                currentMinPrice !== null &&
                price < currentMinPrice
            ) {
                visible = false;
            }


            /*
            | Maximum price
            */

            if (
                visible &&
                currentMaxPrice !== null &&
                price > currentMaxPrice
            ) {
                visible = false;
            }


            /*
            | Search
            */

            if (
                visible &&
                currentSearch &&
                !name.includes(currentSearch.toLowerCase())
            ) {
                visible = false;
            }


            /*
            | Apply
            */

            product.style.display =
                visible ? '' : 'none';


            if (visible) {
                visibleCount++;
            }

        });


        /*
        | Count
        */

        if (countElement) {
            countElement.textContent = visibleCount;
        }


        /*
        | Sort
        */

        if (currentSort !== 'default') {
            sortProducts();
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Sort Products
    |--------------------------------------------------------------------------
    */

    function sortProducts() {

        if (!grid) {
            return;
        }


        const products = getProducts();


        products.sort((a, b) => {

            const aName =
                a.dataset.productName || '';

            const bName =
                b.dataset.productName || '';


            const aPrice =
                parseFloat(a.dataset.productPrice || 0);

            const bPrice =
                parseFloat(b.dataset.productPrice || 0);


            const aId =
                Number(a.dataset.productId || 0);

            const bId =
                Number(b.dataset.productId || 0);


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


        /*
        | Re-append in sorted order
        */

        products.forEach(product => {
            grid.appendChild(product);
        });

    }


    /*
    |--------------------------------------------------------------------------
    | Category Filter
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.category-filter')
        .forEach(filter => {

            filter.addEventListener('click', function (event) {

                event.preventDefault();


                /*
                | Active state
                */

                document
                    .querySelectorAll('.category-filter')
                    .forEach(item => {
                        item.classList.remove('active');
                    });


                this.classList.add('active');


                /*
                | Category
                */

                currentCategory =
                    this.dataset.category ||
                    this.dataset.categoryId ||
                    null;


                filterProducts();

            });

        });


    /*
    |--------------------------------------------------------------------------
    | Price Filter
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('applyPriceFilter')
        ?.addEventListener('click', function () {

            const minElement =
                document.getElementById('minPrice');

            const maxElement =
                document.getElementById('maxPrice');


            currentMinPrice =
                minElement?.value !== ''
                    ? parseFloat(minElement.value)
                    : null;


            currentMaxPrice =
                maxElement?.value !== ''
                    ? parseFloat(maxElement.value)
                    : null;


            filterProducts();

        });


    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('searchProducts')
        ?.addEventListener('input', function () {

            currentSearch =
                this.value.trim();


            filterProducts();

        });


    /*
    |--------------------------------------------------------------------------
    | Sort
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('sortProducts')
        ?.addEventListener('change', function () {

            currentSort =
                this.value;


            filterProducts();

        });


    /*
    |--------------------------------------------------------------------------
    | Clear Filters
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('clearFilters')
        ?.addEventListener('click', function () {

            currentCategory = null;
            currentMinPrice = null;
            currentMaxPrice = null;
            currentSearch = '';
            currentSort = 'default';


            /*
            | Reset inputs
            */

            const minElement =
                document.getElementById('minPrice');

            const maxElement =
                document.getElementById('maxPrice');

            const searchElement =
                document.getElementById('searchProducts');

            const sortElement =
                document.getElementById('sortProducts');


            if (minElement) {
                minElement.value = '';
            }


            if (maxElement) {
                maxElement.value = '';
            }


            if (searchElement) {
                searchElement.value = '';
            }


            if (sortElement) {
                sortElement.value = 'default';
            }


            /*
            | Reset category
            */

            document
                .querySelectorAll('.category-filter')
                .forEach(item => {
                    item.classList.remove('active');
                });


            /*
            | Reset products
            */

            filterProducts();

        });

});

</script>

@endpush
