@extends('Frontend.Layouts.main')

@section('content')

<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($bannerSliders as $index => $slider)
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{ $index }}"
            class="{{ $index == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach($bannerSliders as $index => $slider)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{ asset('storage/' . $slider['image']) }}"
                            alt="{{ $slider['title'] }}">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>{{ $slider['title'] }}</b></h1>
                            <h3 class="h2">{{ Str::limit($slider['shortdesc'], 100) }}</h3>
                            <p>
                                @if($slider['link_text'])
                                <a rel="sponsored" class="text-success" href="{{ $slider['link_url'] }}"
                                    target="_blank">
                                    {{ $slider['link_text'] }} <i class="fas fa-arrow-right"></i>
                                </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->

<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categories of The Month</h1>
            <p>Shop by category and find your perfect style</p>
        </div>
    </div>
    <div class="row">
        @foreach($categories->take(3) as $category)
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="{{ route('shop.category', $category['slug']) }}">
                <img src="{{ asset('storage/categories/' . ($category['image'] ?? 'default-category.jpg')) }}"
                    class="rounded-circle img-fluid border" style="width: 200px; height: 200px; object-fit: cover;">
            </a>
            <h5 class="text-center mt-3 mb-3">{{ $category['name'] }}</h5>
            <p class="text-center">
                <a href="{{ route('shop.category', $category['slug']) }}" class="btn btn-outline-success">Go Shop</a>
            </p>
        </div>
        @endforeach
    </div>
    @if($categories->count() > 3)
    <div class="row text-center mt-3">
        <div class="col-12">
            <a href="{{ route('shop.categories') }}" class="btn btn-outline-success btn-lg">
                View All Categories <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    @endif
</section>
<!-- End Categories of The Month -->

<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Featured Products</h1>
                <p>Discover our hand-picked featured products just for you</p>
            </div>
        </div>
        <div class="row">
            @foreach($featuredProducts as $product)
            <div class="col-12 col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('shop.product', $product['slug']) }}">
                        <img src="{{ asset('storage/products/' . ($product['thumbnail'] ?? 'default-product.jpg')) }}"
                            class="card-img-top" alt="{{ $product['name'] }}" style="height: 250px; object-fit: cover;">
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between align-items-center mb-3">
                            <li>
                                @php
                                $rating = rand(3, 5); // Dynamic rating placeholder
                                @endphp
                                @for($i = 1; $i <= 5; $i++) <i
                                    class="fa fa-star {{ $i <= $rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </li>
                            <li class="text-right">
                                @if($product['sale_price'] && $product['sale_price'] < $product['price']) <span
                                    class="text-danger fw-bold">${{ number_format($product['sale_price'], 2) }}</span>
                                    <span class="text-muted text-decoration-line-through ms-2">${{
                                        number_format($product['price'], 2) }}</span>
                                    @else
                                    <span class="fw-bold">${{ number_format($product['price'], 2) }}</span>
                                    @endif
                            </li>
                        </ul>
                        <a href="{{ route('shop.product', $product['slug']) }}"
                            class="h5 text-decoration-none text-dark fw-bold">
                            {{ $product['name'] }}
                        </a>
                        <p class="card-text text-muted mt-2">
                            {{ Str::limit($product['description'] ?? 'No description available', 80) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="badge bg-secondary">{{ $product['category']['name'] ?? 'Uncategorized'
                                }}</span>
                            <button class="btn btn-sm btn-outline-success add-to-cart"
                                data-product-id="{{ $product['id'] }}">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row text-center mt-4">
            <div class="col-12">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-success btn-lg px-5">
                    View All Products <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End Featured Product -->

<!-- Start Bundles/Combos Section -->
@if(isset($bundles) && count($bundles) > 0)
<section class="container py-5">
    <div class="row text-center py-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Bundle Deals 🔥</h1>
            <p>Save more with our combo offers - Limited time only!</p>
        </div>
    </div>
    <div class="row">
        @foreach($bundles->take(4) as $bundle)
        <div class="col-12 col-md-6 col-lg-3 mb-4">
            <div class="card h-100 border-success shadow-sm">
                <div class="position-relative">
                    @if($bundle['sale_price'])
                    <span class="position-absolute top-0 start-0 badge bg-danger m-2">SALE</span>
                    @endif
                    @if($bundle['is_new'])
                    <span class="position-absolute top-0 end-0 badge bg-info m-2">NEW</span>
                    @endif
                    <a href="{{ route('shop.product', $bundle['slug']) }}">
                        <img src="{{ asset('storage/products/' . ($bundle['thumbnail'] ?? 'default-product.jpg')) }}"
                            class="card-img-top" alt="{{ $bundle['name'] }}" style="height: 200px; object-fit: cover;">
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $bundle['name'] }}</h5>
                    <p class="card-text">
                        @if($bundle['sale_price'])
                        <span class="text-danger fw-bold h5">${{ number_format($bundle['sale_price'], 2) }}</span>
                        <span class="text-muted text-decoration-line-through ms-2">${{ number_format($bundle['price'],
                            2) }}</span>
                        <span class="badge bg-success ms-2">
                            Save {{ round((($bundle['price'] - $bundle['sale_price']) / $bundle['price']) * 100) }}%
                        </span>
                        @else
                        <span class="fw-bold h5">${{ number_format($bundle['price'], 2) }}</span>
                        @endif
                    </p>
                    <a href="{{ route('shop.product', $bundle['slug']) }}" class="btn btn-outline-success w-100">
                        View Bundle <i class="fas fa-tags"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @if($bundles->count() > 4)
    <div class="row text-center mt-3">
        <div class="col-12">
            <a href="#" class="btn btn-outline-success btn-lg">
                View All Bundles <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    @endif
</section>
@endif
<!-- End Bundles Section -->

<!-- Pagination for Featured Products (if using pagination) -->
@if(method_exists($featuredProducts, 'links'))
<div class="container">
    <div class="row">
        <div class="col-12">
            {{ $featuredProducts->links() }}
        </div>
    </div>
</div>
@endif

@endsection

@push('styles')
<style>
    /* Card hover effects */
    .card {
        transition: all 0.3s ease-in-out;
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
    }

    /* Category images */
    .rounded-circle {
        transition: transform 0.3s ease;
        width: 180px;
        height: 180px;
        object-fit: cover;
    }

    .rounded-circle:hover {
        transform: scale(1.05);
    }

    /* Button styles */
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
        transform: translateY(-2px);
    }

    .btn-outline-success:hover {
        transform: translateY(-2px);
    }

    /* Carousel controls */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0.8;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1;
    }

    /* Badge styles */
    .badge {
        padding: 5px 10px;
        font-weight: 500;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .rounded-circle {
            width: 140px;
            height: 140px;
        }

        .carousel-item .row {
            padding: 2rem !important;
        }
    }

    /* Pagination styling */
    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .page-item.active .page-link {
        background-color: #28a745;
        border-color: #28a745;
    }

    .page-link {
        color: #28a745;
    }

    .page-link:hover {
        color: #218838;
    }
</style>
@endpush

@push('scripts')
<script>
    // Bootstrap 5 fallback
    if (typeof bootstrap === 'undefined') {
        console.log('Loading Bootstrap fallback...');
        var script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js';
        document.head.appendChild(script);
    }

    // Font Awesome fallback
    if (!document.querySelector('link[href*="font-awesome"]')) {
        var faLink = document.createElement('link');
        faLink.rel = 'stylesheet';
        faLink.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css';
        document.head.appendChild(faLink);
    }

    // Add to Cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const productId = this.dataset.productId;

            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            this.disabled = true;

            // Simulate AJAX call (replace with actual endpoint)
            setTimeout(() => {
                // Your actual cart addition logic here
                console.log('Product ' + productId + ' added to cart');

                // Show success feedback
                this.innerHTML = '<i class="fas fa-check"></i> Added!';
                this.classList.remove('btn-outline-success');
                this.classList.add('btn-success');

                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.disabled = false;
                    this.classList.remove('btn-success');
                    this.classList.add('btn-outline-success');
                }, 2000);

                // You can trigger a toast notification here
                showToast('Product added to cart successfully!');
            }, 500);
        });
    });

    // Toast notification function
    function showToast(message) {
        // Create toast container if not exists
        let toastContainer = document.querySelector('.toast-container');
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container position-fixed bottom-0 end-0 p-3';
            toastContainer.style.zIndex = '1050';
            document.body.appendChild(toastContainer);
        }

        // Create toast
        const toastEl = document.createElement('div');
        toastEl.className = 'toast align-items-center text-white bg-success border-0';
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');
        toastEl.setAttribute('aria-atomic', 'true');

        toastEl.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i> ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;

        toastContainer.appendChild(toastEl);

        // Initialize and show toast
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();

        // Remove toast after hidden
        toastEl.addEventListener('hidden.bs.toast', () => {
            toastEl.remove();
        });
    }

    // Lazy loading images
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
</script>
@endpush