<div class="col-lg-3 col-md-4 mb-4 mb-md-0">
    <h1 class="h2 pb-4 pb-md-3">Categories</h1>

    <!-- SEARCH -->
    <div class="mb-3">
        <input type="text" id="searchProducts" class="form-control" placeholder="Search products...">
    </div>

    <!-- PRICE -->
    <div class="mb-3">
        <h5 class="fw-bold">Price Range</h5>

        <div class="row g-2">
            <div class="col-6">
                <input type="number" id="minPrice" class="form-control form-control-sm" placeholder="Min">
            </div>
            <div class="col-6">
                <input type="number" id="maxPrice" class="form-control form-control-sm" placeholder="Max">
            </div>
        </div>

        <button id="applyPriceFilter" class="btn btn-success btn-sm w-100 mt-2">
            Apply Filter
        </button>
    </div>

    <!-- SORT -->
    <div class="mb-3">
        <h5 class="fw-bold">Sort By</h5>

        <select id="sortProducts" class="form-select form-select-sm">
            <option value="default">Default</option>
            <option value="price_asc">Price: Low to High</option>
            <option value="price_desc">Price: High to Low</option>
            <option value="name_asc">Name: A to Z</option>
            <option value="name_desc">Name: Z to A</option>
            <option value="newest">Newest First</option>
        </select>
    </div>

    <!-- CATEGORIES -->
    <ul class="list-unstyled">
        @foreach($categories as $parent)
        <li class="mb-2">

            <a class="category-parent d-flex justify-content-between align-items-center text-decoration-none py-2 px-2 rounded"
                data-bs-toggle="collapse" href="#cat-{{ $parent['id'] }}" role="button">

                <span>{{ $parent['name'] }}</span>

                <i class="fas fa-chevron-down category-arrow"></i>
            </a>

            <ul class="collapse ps-3" id="cat-{{ $parent['id'] }}">

                @foreach($parent['children'] as $child)
                <li>
                    <a href="#" class="category-filter d-block py-1 text-decoration-none text-dark"
                        data-category="{{ $child['id'] }}">
                        {{ $child['name'] }}
                    </a>
                </li>
                @endforeach

            </ul>

        </li>
        @endforeach
    </ul>

    <!-- CLEAR -->
    <button id="clearFilters" class="btn btn-outline-secondary btn-sm w-100 mt-3">
        Clear All Filters
    </button>
</div>

<style>
    .category-parent {
        color: #212529;
        transition: all .2s ease;
    }

    .category-parent:hover {
        background: #f8f9fa;
        color: #198754;
    }

    .category-parent[aria-expanded="true"] {
        background: #f8f9fa;
    }
</style>

<style>
    .category-parent[aria-expanded="true"] .category-arrow {
        transform: rotate(180deg);
    }

    .category-arrow {
        transition: transform .25s ease;
        font-size: 12px;
    }
</style>