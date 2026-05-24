<!-- Start Top Nav -->
<nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">

    <div class="container text-light">

        <div class="w-100 d-flex justify-content-between">

            <div>

                @if(!empty($email))
                <i class="fa fa-envelope mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:{{ $email }}">
                    {{ $email }}
                </a>
                @endif

                @if(!empty($phone))
                <i class="fa fa-phone mx-2"></i>
                <a class="navbar-sm-brand text-light text-decoration-none" href="tel:{{ $phone }}">
                    {{ $phone }}
                </a>
                @endif

            </div>

            <div>

                @if(!empty($facebook))
                <a class="text-light" href="{{ $facebook }}" target="_blank">
                    <i class="fab fa-facebook-f fa-sm fa-fw me-2"></i>
                </a>
                @endif

                @if(!empty($instagram))
                <a class="text-light" href="{{ $instagram }}" target="_blank">
                    <i class="fab fa-instagram fa-sm fa-fw me-2"></i>
                </a>
                @endif

                @if(!empty($tiktok))
                <a class="text-light" href="{{ $tiktok }}" target="_blank">
                    <i class="fab fa-tiktok fa-sm fa-fw me-2"></i>
                </a>
                @endif

            </div>

        </div>

    </div>

</nav>
<!-- Close Top Nav -->


<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="{{ route('index') }}">
            AFashion
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">

                <a class="nav-icon position-relative text-decoration-none" href="#">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                    <span
                        class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="#">
                    <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    <span
                        class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>
            </div>
        </div>

    </div>
</nav>
<!-- Close Header -->