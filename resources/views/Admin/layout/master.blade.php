<!DOCTYPE html>
<html lang="en">

<header>
    @include('Admin.layout.header')

</header>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <div class="row justify-around bg-white shadow-sm">



            <!-- RIGHT SIDE (LOGO) -->
            <div class="col-9  col-md-11 col-lg-11 align-items-center ms-auto">

                <a class="navbar-brand p-2 m-2" href="{{ url('/') }}">

                    <img src="{{ $logo ?? asset('front/images/logo.png') }}" alt="logo"
                        style="height:40px; width:auto; object-fit:contain;">

                </a>

            </div><!-- LEFT SIDE -->
            <div class="col-3 col-md-1 col-lg-1">

                <!-- Sidebar toggle (desktop minimize) -->


                <!-- Mobile sidebar toggle -->
                <button class="btn btn-dark " data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
                    <i class="mdi mdi-menu"></i>
                </button>

            </div>
        </div>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->

            @include('Admin.layout.navbar')
            <!-- partial -->
            <div class="main-panel">
                @if(session('success'))
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