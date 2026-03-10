<section class="hero-small">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active banner-image"
                data-banner="{{ $pageBanner->image ? asset('uploads/' . $pageBanner->image) : asset('assets/images/banner22.jpg') }}">
                <div class="hero-small-background-overlay"></div>
                <div class="container h-100">
                    <div class="row align-items-center d-flex h-100">
                        <div class="col-md-12">
                            <div class="block">
                                <span class="text-uppercase text-sm letter-spacing"></span>
                                <h3 class="mb-3 mt-3 text-center text-white">
                                    Services &nbsp <i class="fa-solid fa-angle-right"></i> &nbsp
                                    {{ $serviceDetail->name ?? '' }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@push('scripts')
    <script>
        < script >
            document.addEventListener('DOMContentLoaded', function() {
                const bannerEl = document.querySelector('.banner-image');
                if (bannerEl) {
                    const imageUrl = bannerEl.getAttribute('data-banner');
                    if (imageUrl) {
                        bannerEl.style.backgroundImage = `url('${imageUrl}')`;
                    }
                }
            });
    </script>

    </script>
@endpush
@push('styles')
    <style>
        .banner-image {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 500px;
            position: relative;
        }

        /* Overlay */
        .hero-small-background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        /* Make text appear above overlay */
        .carousel-item .container {
            position: relative;
            z-index: 2;
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            .banner-image {
                height: 250px;
                background-position: center top;
                /* Try different values if important part is getting cut */
            }

            .banner-image h3 {
                font-size: 1.2rem;
                padding: 0 10px;
            }
        }
    </style>
@endpush
