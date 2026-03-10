<!DOCTYPE html>
<html lang="en">

<header>
    @include('Admin.layout.header')

</header>

<body class="with-welcome-text">
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                        <img src="{{ $logo ?? asset('front/images/logo.png') }}" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                        <img src="{{ asset('front/images/logo.png') }}" alt="logo" />
                    </a>
                </div>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                @include('Admin.layout.navbar')
            </nav>
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
