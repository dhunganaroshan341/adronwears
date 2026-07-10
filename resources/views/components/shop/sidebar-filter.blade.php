<div class="filter-sidebar">
    <h1 class="filter-title mb-4">Categories</h1>

    <!-- SEARCH -->
    <div class="filter-block">
        <input type="text" id="searchProducts" class="filter-input" placeholder="Search products...">
    </div>

    <!-- PRICE -->
    <div class="filter-block">
        <h5 class="filter-label">Price Range</h5>
        <div class="row g-2">
            <div class="col-6">
                <input type="number" id="minPrice" class="filter-input filter-input-sm" placeholder="Min">
            </div>
            <div class="col-6">
                <input type="number" id="maxPrice" class="filter-input filter-input-sm" placeholder="Max">
            </div>
        </div>
        <button id="applyPriceFilter" class="btn-minimal w-100 mt-2">Apply Filter</button>
    </div>

    <!-- SORT -->
    <div class="filter-block">
        <h5 class="filter-label">Sort By</h5>
        <select id="sortProducts" class="filter-input">
            <option value="default">Default</option>
            <option value="price_asc">Price: Low to High</option>
            <option value="price_desc">Price: High to Low</option>
            <option value="name_asc">Name: A to Z</option>
            <option value="name_desc">Name: Z to A</option>
            <option value="newest">Newest First</option>
        </select>
    </div>

    <!-- CATEGORIES -->
    <div class="filter-block">
        <ul class="list-unstyled category-tree mb-0">
            @foreach($categories as $parent)
            <li class="mb-1">
                <a class="category-parent d-flex justify-content-between align-items-center text-decoration-none"
                    data-bs-toggle="collapse" href="#cat-{{ $parent['id'] }}" role="button">
                    <span>{{ $parent['name'] }}</span>
                    <i class="fas fa-chevron-down category-arrow"></i>
                </a>
                <ul class="collapse ps-3" id="cat-{{ $parent['id'] }}">
                    @foreach($parent['children'] as $child)
                    <li>
                        <a href="#" class="category-filter d-block text-decoration-none"
                            data-category="{{ $child['id'] }}">
                            {{ $child['name'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>

    <!-- CLEAR -->
    <button id="clearFilters" class="btn-minimal-outline w-100">Clear All Filters</button>
</div>


<style>
    .filter-sidebar {
        border-right: 1px solid #e7e7e7;
        padding-right: 1.5rem;
    }

    .filter-title {
        font-size: 1.3rem;
        font-weight: 600;
        letter-spacing: -.01em;
        margin-bottom: 0;
    }

    .filter-block {
        padding: 1.1rem 0;
        border-bottom: 1px solid #e7e7e7;
    }

    .filter-label {
        font-size: .72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #767676;
        margin-bottom: .6rem;
    }

    .filter-input {
        width: 100%;
        border: 1px solid #e7e7e7;
        background: #fff;
        color: #111;
        padding: .55rem .7rem;
        font-size: .85rem;
        border-radius: 6px;
        transition: .2s;
    }

    .filter-input:focus {
        outline: none;
        border-color: #111;
    }

    .filter-input-sm {
        font-size: .8rem;
        padding: .45rem .6rem;
    }

    .btn-minimal {
        width: 100%;
        background: #111;
        color: #fff;
        border: 1px solid #111;
        border-radius: 6px;
        font-size: .78rem;
        padding: .55rem;
        transition: .25s;
    }

    .btn-minimal:hover {
        opacity: .9;
        color: #fff;
    }

    .btn-minimal-outline {
        width: 100%;
        background: #fff;
        color: #111;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: .78rem;
        padding: .55rem;
        transition: .25s;
    }

    .btn-minimal-outline:hover {
        background: #111;
        color: #fff;
    }

    .category-tree {
        font-size: .9rem;
    }

    .category-parent {
        color: #111;
        font-weight: 500;
        padding: .45rem .2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .category-arrow {
        transition: .25s;
        font-size: 10px;
        color: #888;
    }

    .category-parent[aria-expanded="true"] .category-arrow {
        transform: rotate(180deg);
    }

    .category-filter {
        color: #666;
        display: block;
        font-size: .85rem;
        padding: .35rem .2rem;
        transition: .2s;
    }

    .category-filter:hover {
        color: #111;
        padding-left: .35rem;
    }

    .category-filter.active {
        color: #111;
        font-weight: 600;
    }

    /* =======================================================
   MOBILE
=======================================================*/

    @media (max-width:767px) {

        .filter-sidebar {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            border: none;
            padding: 0;
        }

        .filter-title {
            grid-column: 1/-1;
            text-align: center;
        }

        /* Search */
        .filter-block:first-of-type {
            grid-column: 1/-1;
        }

        /* Price */
        .filter-block:nth-of-type(2) {
            grid-column: span 2;
        }

        /* Sort */
        .filter-block:nth-of-type(3) {
            grid-column: span 1;
        }

        /* Categories -> FULL WIDTH */
        .filter-block:nth-of-type(4) {
            grid-column: 1/-1;
        }

        /* Clear button */
        #clearFilters {
            grid-column: 1/-1;
        }

        .filter-block {
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        }

        .category-tree {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
            max-height: none;
            overflow: visible;
        }

        .category-tree>li {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 8px;
        }

        .category-parent {
            font-size: .85rem;
            font-weight: 600;
        }

        .category-filter {
            padding: 6px 0;
            font-size: .8rem;
        }
    }

    /* =======================================================
   EXTRA SMALL
=======================================================*/

    @media (max-width:480px) {

        .filter-sidebar {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .filter-block {
            padding: .65rem;
        }

        .filter-block:first-of-type,
        .btn-minimal-outline {
            grid-column: 1/-1;
        }

        .filter-title {
            font-size: 1rem;
        }
    }
</style>