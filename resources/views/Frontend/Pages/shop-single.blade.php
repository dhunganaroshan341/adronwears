@extends('Frontend.Layouts.main')

@section('content')

<section class="bg-light py-5">
    <div class="container">

        <div class="row">

            {{-- PRODUCT IMAGE --}}
            <div class="col-lg-5">

                <div class="card mb-3">



                    <img class="card-img img-fluid" src="{{ $product['thumbnail']??'' }}" alt="{{ $product['name'] }}">
                </div>

                {{-- GALLERY --}}
                @if(!empty($product['images']))
                <div class="row">

                    @foreach($product['images'] as $image)

                    @php
                    $galleryImage = str_replace(
                    'http://127.0.0.1:8000/uploads/',
                    '',
                    trim($image['image_path'])
                    );
                    @endphp

                    <div class="col-4 mb-3">
                        <img src="{{ asset('uploads/' . ltrim($galleryImage, '/')) }}" class="img-fluid border rounded"
                            alt="{{ $product['name'] }}">
                    </div>

                    @endforeach

                </div>
                @endif

            </div>

            {{-- PRODUCT DETAILS --}}
            <div class="col-lg-7">

                <div class="card">
                    <div class="card-body">

                        <h1 class="h2">
                            {{ $product['name'] }}
                        </h1>

                        {{-- CATEGORY --}}
                        <p class="text-muted mb-2">
                            Category:
                            {{ $product['category']['name'] ?? 'N/A' }}
                        </p>

                        {{-- PRICE --}}
                        <div class="mb-3">

                            @if($product['sale_price'])

                            <h3 class="text-danger">
                                Rs. {{ number_format($product['sale_price']) }}
                            </h3>

                            <del class="text-muted">
                                Rs. {{ number_format($product['price']) }}
                            </del>

                            @else

                            <h3>
                                Rs. {{ number_format($product['price']) }}
                            </h3>

                            @endif

                        </div>

                        {{-- BADGES --}}
                        <div class="mb-3">

                            @if($product['is_new'])
                            <span class="badge bg-primary">New</span>
                            @endif

                            @if($product['is_featured'])
                            <span class="badge bg-warning text-dark">
                                Featured
                            </span>
                            @endif

                            @if($product['is_on_sale'])
                            <span class="badge bg-danger">
                                Sale
                            </span>
                            @endif

                        </div>

                        {{-- STOCK --}}
                        <div class="mb-3">

                            @if($product['total_stock'] > 0)

                            <span class="text-success">
                                In Stock
                            </span>

                            @else

                            <span class="text-danger">
                                Out of Stock
                            </span>

                            @endif

                        </div>

                        {{-- TARGET GROUP --}}
                        <div class="mb-3">
                            <strong>Target Group:</strong>
                            {{ ucfirst($product['target_group']) }}
                        </div>

                        {{-- BRAND --}}
                        @if($product['brand_name'])
                        <div class="mb-3">
                            <strong>Brand:</strong>
                            {{ $product['brand_name'] }}
                        </div>
                        @endif

                        {{-- DESCRIPTION --}}
                        <div class="mb-4">
                            <h5>Description</h5>

                            {!! $product['description'] !!}
                        </div>

                        {{-- REQUEST BUTTON --}}
                        <!-- <button class="btn btn-outline-success" data-bs-toggle="modal"
                            data-bs-target="#productRequestModal">
                            Request This Product
                        </button> -->
                        @include('components.product.whatsapp-cart-button', ['product' => $product])


                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


{{-- RELATED PRODUCTS --}}
<section class="py-5">

    <div class="container">

        <div class="row mb-4">
            <div class="col">
                <h3>Related Products</h3>
            </div>
        </div>

        <div id="carousel-related-product">

            @foreach($relatedProducts as $related)

            @php

            $relatedThumbnail = str_replace(
            'http://127.0.0.1:8000/uploads/',
            '',
            $related['thumbnail']
            );

            @endphp

            <div class="p-2">

                <div class="card h-100 shadow-sm border-0">

                    <a href="{{ route('shop.product', $related['slug']) }}">

                        <img class="card-img-top img-fluid" src="{{ $related['thumbnail']??'' }}"
                            alt="{{ $related['name'] }}" style="height:300px; object-fit:cover;">

                    </a>

                    <div class="card-body">
                        @include('components.product.whatsapp-cart-button', ['product' => $product])

                        <h5 class="card-title">
                            {{ $related['name'] }}
                        </h5>

                        <p class="text-muted mb-2">
                            {{ $related['category']['name'] ?? 'N/A' }}
                        </p>

                        {{-- PRICE --}}
                        @if($related['sale_price'])

                        <h6 class="text-danger">
                            Rs. {{ number_format($related['sale_price']) }}
                        </h6>

                        <small class="text-muted">
                            <del>
                                Rs. {{ number_format($related['price']) }}
                            </del>
                        </small>

                        @else

                        <h6>
                            Rs. {{ number_format($related['price']) }}
                        </h6>

                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('shop.product', $related['slug']) }}"
                                    class="btn btn-outline-dark btn-sm mt-2">
                                    View Product
                                </a>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>
    <x-product.whatsapp-request-modal />

</section>

@endsection


@push('styles')

<link rel="stylesheet" href="{{ asset('fashion-shop-template/assets/css/slick.min.css') }}">

<link rel="stylesheet" href="{{ asset('fashion-shop-template/assets/css/slick-theme.css') }}">

@endpush


@push('scripts')

<script src="{{ asset('fashion-shop-template/assets/js/slick.min.js') }}"></script>

<script>

    $('#carousel-related-product').slick({
        infinite: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,

        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3
                }
            },

            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },

            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

</script>

@endpush