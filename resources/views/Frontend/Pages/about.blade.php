@extends('Frontend.Layouts.main')

@section('content')

<!-- About Banner -->
<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-8 text-white">
                <h1>About Adron Fashion Wear</h1>
                <p class="mt-3">
                    Adron Fashion Wear is a trusted fashion destination located in
                    Koteshwor-32, Kathmandu, Nepal. For more than 7 years, we have been
                    proudly serving our customers with high-quality clothing and accessories.
                </p>
                <p>
                    With two successful store locations, we offer a wide collection of
                    trendy, modern, and classic fashion items for men and women.
                    Our goal is to deliver style, comfort, and affordability in every product.
                </p>
                <p>
                    In addition to retail sales, we also handle bulk orders and provide
                    international shipping services for wholesale customers.
                </p>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('assets/img/about-hero.svg') }}" class="img-fluid" alt="Adron Fashion Wear">
            </div>
        </div>
    </div>
</section>
<!-- Close Banner -->


<!-- Our Services -->
<section class="container py-5">
    <div class="row text-center pt-5 pb-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Our Services</h1>
            <p>
                Delivering quality fashion products with trusted service for over 7 years.
            </p>
        </div>
    </div>

    <div class="row">

        <!-- Trendy Fashion -->
        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center">
                    <i class="fa fa-tshirt fa-lg"></i>
                </div>
                <h2 class="h5 mt-4 text-center">Trendy Fashion Collection</h2>
                <p class="text-center px-3">
                    Stay ahead with the latest fashion trends and modern styles.
                </p>
            </div>
        </div>

        <!-- Classic Wear -->
        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center">
                    <i class="fa fa-user-tie fa-lg"></i>
                </div>
                <h2 class="h5 mt-4 text-center">Classic & Formal Wear</h2>
                <p class="text-center px-3">
                    Timeless and elegant pieces suitable for every occasion.
                </p>
            </div>
        </div>

        <!-- Accessories -->
        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center">
                    <i class="fa fa-shopping-bag fa-lg"></i>
                </div>
                <h2 class="h5 mt-4 text-center">Fashion Accessories</h2>
                <p class="text-center px-3">
                    Complete your look with quality accessories and essentials.
                </p>
            </div>
        </div>

        <!-- Bulk & International -->
        <div class="col-md-6 col-lg-3 pb-5">
            <div class="h-100 py-5 services-icon-wap shadow">
                <div class="h1 text-success text-center">
                    <i class="fa fa-globe fa-lg"></i>
                </div>
                <h2 class="h5 mt-4 text-center">Bulk & International Shipping</h2>
                <p class="text-center px-3">
                    We support wholesale orders and ship internationally with reliability.
                </p>
            </div>
        </div>

    </div>
</section>
<!-- End Section -->


<!-- Our Collections / Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Collections</h1>
                <p>
                    Discover a wide range of carefully selected fashion collections
                    designed to combine comfort, durability, and modern style.
                </p>
            </div>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-4 mb-4">
                <div class="p-4 shadow-sm bg-white">
                    <h5>Men's Wear</h5>
                    <p>Casual, formal, and street-style fashion for men.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 shadow-sm bg-white">
                    <h5>Women's Wear</h5>
                    <p>Modern, elegant, and trendy outfits for every occasion.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="p-4 shadow-sm bg-white">
                    <h5>Accessories</h5>
                    <p>Handpicked fashion accessories to enhance your look.</p>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- End Brands -->

@endsection