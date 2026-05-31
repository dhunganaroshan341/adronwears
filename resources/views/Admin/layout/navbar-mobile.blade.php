@php
$idPrefix = $mode === 'desktop' ? 'd' : 'm';
@endphp

<ul class="nav flex-column p-2">

    <li class="nav-item nav-category">Core</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user') }}">
            <i class="mdi mdi-account menu-icon"></i>
            Users
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.setting.index') }}">
            <i class="mdi mdi-cog menu-icon"></i>
            Settings
        </a>
    </li>

    {{-- ================= PRODUCT ================= --}}
    <li class="nav-item nav-category">Product Management</li>

    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#manageMenu{{ $idPrefix }}">

            <i class="mdi mdi-package-variant menu-icon"></i>
            Manage
        </a>

        <div class="collapse" id="manageMenu{{ $idPrefix }}">
            <ul class="nav flex-column sub-menu">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.gallery-albums.index') }}">
                        Gallery
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product-categories.index') }}">
                        Product Categories
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.shipping-requests.index') }}">
                        Shipping Requests
                    </a>
                </li>

            </ul>
        </div>
    </li>

    {{-- ================= CONTENT ================= --}}
    <li class="nav-item nav-category">Content</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.homeslide') }}">
            Home Slider
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.brand.index') }}">
            Brands
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.team.index') }}">
            Team
        </a>
    </li>

    {{-- ================= BLOG ================= --}}
    <li class="nav-item nav-category">Media</li>

    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#blogMenu{{ $idPrefix }}">

            Blogs
        </a>

        <div class="collapse" id="blogMenu{{ $idPrefix }}">
            <ul class="nav flex-column sub-menu">

                <li><a class="nav-link" href="{{ route('admin.category') }}">Category</a></li>
                <li><a class="nav-link" href="{{ route('admin.post') }}">Post</a></li>

            </ul>
        </div>
    </li>

    {{-- CONTACT --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contact.index') }}">
            Contact
        </a>
    </li>

    {{-- LOGOUT --}}
    <li class="nav-item">
        <a class="nav-link text-danger" href="{{ route('admin.logout') }}">
            Logout
        </a>
    </li>

</ul>