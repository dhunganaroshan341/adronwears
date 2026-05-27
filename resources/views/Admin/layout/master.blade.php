<!DOCTYPE html>
<html lang="en">

<header>
    @include('Admin.layout.header')

</header>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav
            class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-center justify-content-between bg-white shadow-sm">

            <!-- LEFT SIDE -->
            <div class="d-flex align-items-center">

                <!-- Sidebar toggle (desktop minimize) -->


                <!-- Mobile sidebar toggle -->
                <button class="btn btn-dark " data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
                    <i class="mdi mdi-menu"></i>
                </button>

            </div>

            <!-- RIGHT SIDE (LOGO) -->
            <div class="d-flex align-items-center ms-auto">

                <a class="navbar-brand p-0 m-0" href="{{ url('/') }}">

                    <img src="{{ $logo ?? asset('front/images/logo.png') }}" alt="logo"
                        style="height:32px; width:auto; object-fit:contain;">

                </a>

            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->

            @include('Admin.layout.navbar')
            <!-- partial -->
            <div class="main-panel">
                @if(session('success'))CORE
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @yield('content')


                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('Admin.layout.footer-script')

</body>

</html>