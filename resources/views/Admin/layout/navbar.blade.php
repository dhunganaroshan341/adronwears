<!-- Mobile Toggle -->
<!-- <button class="btn btn-dark d-lg-none m-2" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
    <i class="mdi mdi-menu"></i>
</button> -->

<!-- Sidebar -->
<div class="offcanvas offcanvas-start sidebar bg-white" id="adminSidebar" data-bs-backdrop="true"
    data-bs-scroll="false">
    <div class="offcanvas-header d-lg-none">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">

        <ul class="nav flex-column p-2">

            {{-- YOUR ENTIRE MENU HERE (UNCHANGED) --}}


            {{-- ONLY WRAPPED INSIDE OFFCANVAS BODY --}}



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


            {{-- === PRODUCT MANAGEMENT === --}}
            <li class="nav-item nav-category">
                Product Management
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#manageMenu">

                    <i class="mdi mdi-package-variant menu-icon"></i>
                    <span class="menu-title">Manage</span>

                    <i class="menu-arrow"></i>
                </a>

                <div class="collapse" id="manageMenu">
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
                                All Products
                            </a>
                        </li>

                    </ul>
                </div>
            </li>



            {{-- === CONTENT === --}}
            <li class="nav-item nav-category">
                Content
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#bannerMenu">

                    <i class="mdi mdi-image-multiple menu-icon"></i>

                    <span class="menu-title">
                        Banners
                    </span>

                    <i class="menu-arrow"></i>

                </a>

                <div class="collapse" id="bannerMenu">
                    <ul class="nav flex-column sub-menu">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.homeslide') }}">
                                Home Slider
                            </a>
                        </li>

                    </ul>
                </div>

            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.brand.index') }}">

                    <i class="mdi mdi-tag-multiple menu-icon"></i>

                    <span class="menu-title">
                        Brands
                    </span>

                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.team.index') }}">

                    <i class="mdi mdi-account-group menu-icon"></i>

                    <span class="menu-title">
                        Team
                    </span>

                </a>
            </li>

            {{-- === MEDIA === --}}
            <li class="nav-item nav-category">
                Media & Marketing
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.notice.index') }}">

                    <i class="mdi mdi-bullhorn menu-icon"></i>

                    <span class="menu-title">
                        Notice
                    </span>

                </a>
            </li>


            <li class="nav-item">

                <a class="nav-link" data-bs-toggle="collapse" href="#blogSubmenu">

                    <i class="mdi mdi-post-outline menu-icon"></i>

                    <span class="menu-title">
                        Blogs
                    </span>

                    <i class="menu-arrow"></i>

                </a>


                <div class="collapse" id="blogSubmenu">

                    <ul class="nav flex-column sub-menu">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.category') }}">
                                Category
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.post') }}">
                                Post
                            </a>
                        </li>

                    </ul>

                </div>

            </li>
            <li class="nav-item nav-category">
                Utilities
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contact.index') }}">

                    <i class="mdi mdi-contacts menu-icon"></i>

                    <span class="menu-title">
                        Contact
                    </span>

                </a>
            </li>

            <!-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.newsletters.index') }}">

                <i class="mdi mdi-email-newsletter menu-icon"></i>

                <span class="menu-title">
                    NewsLetters
                </span>

            </a>
        </li> -->



            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">

                    <i class="mdi mdi-logout menu-icon text-danger"></i>

                    <span class="menu-title text-danger">
                        Logout
                    </span>

                </a>
            </li>

        </ul>
    </div>

</div>
<!-- sidebar  -->