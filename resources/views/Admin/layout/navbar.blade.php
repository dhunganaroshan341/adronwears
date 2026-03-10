<ul class="nav">

    {{-- === CORE SETTINGS === --}}
    <li class="nav-item nav-category">Core</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user') }}">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Users</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.setting.index') }}">
            <i class="mdi mdi-cog menu-icon"></i>
            <span class="menu-title">General Settings</span>
        </a>
    </li>


    {{-- === Product OPERATIONS === --}}

    <li class="nav-item nav-category">Product Management</li>



    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#bannerMenu" role="button" aria-expanded="false"
            aria-controls="bannerMenu">
            <i class="mdi mdi-image-multiple menu-icon"></i>
            <span class="menu-title">Manage</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="bannerMenu">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.gallery-albums.index') }}">Gallery</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product-categories.index') }}">Product
                        Categories</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}"> All
                        Products</a>
                </li>


            </ul>
        </div>
    </li>
    {{-- === CONTENT MANAGEMENT === --}}
    <li class="nav-item nav-category">Content</li>

    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.pages.index') }}">
            <i class="mdi mdi-file-document menu-icon"></i>
            <span class="menu-title">Pages & Sections</span>
        </a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#bannerMenu" role="button" aria-expanded="false"
            aria-controls="bannerMenu">
            <i class="mdi mdi-image-multiple menu-icon"></i>
            <span class="menu-title">Banners</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="bannerMenu">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.homeslide') }}">Home Slider</a></li>

                <!-- <li class="nav-item"><a class="nav-link" href="{{ route('admin.banner.video.index') }}">Video Banner</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.page-banner.index') }}">Page Banner</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.call-to-action.index') }}">CTA Banner</a>
                </li> -->
            </ul>
        </div>
    </li>

    <!-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.service.index') }}">
            <i class="mdi mdi-face-agent menu-icon"></i>
            <span class="menu-title">service page</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.testimonial') }}">
            <i class="mdi mdi-animation menu-icon"></i>
            <span class="menu-title">Testimonials</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.achievements.index') }}">
            <i class="mdi mdi-trophy menu-icon"></i>
            <span class="menu-title">Counter / Achievements</span>
        </a>
    </li> -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.client.index') }}">
            <i class="mdi mdi-account-group-outline menu-icon"></i>
            <span class="menu-title">Brands</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.team.index') }}">
            <i class="mdi mdi-sitemap menu-icon"></i>
            <span class="menu-title">Team</span>
        </a>
    </li>



    {{-- === MARKETING & MEDIA === --}}
    <li class="nav-item nav-category">Media & Marketing</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.notice.index') }}">
            <i class="mdi mdi-bullhorn menu-icon"></i>
            <span class="menu-title">Notice</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#blogSubmenu" role="button" aria-expanded="false"
            aria-controls="blogSubmenu">
            <i class="mdi mdi-post-outline menu-icon"></i>
            <span class="menu-title">Blogs</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="blogSubmenu">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.category') }}">Category</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.post') }}">Post</a></li>
            </ul>
        </div>
    </li>

    {{-- === UTILITIES === --}}
    <li class="nav-item nav-category">Utilities</li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.contact.index') }}">
            <i class="mdi mdi-contacts menu-icon"></i>
            <span class="menu-title">Contact</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.newsletters.index') }}">
            <i class="mdi mdi-contacts menu-icon"></i>
            <span class="menu-title">NewsLetters</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.logout') }}">
            <i class="mdi mdi-logout menu-icon text-danger"></i>
            <span class="menu-title text-danger">Logout</span>
        </a>
    </li>
</ul>
