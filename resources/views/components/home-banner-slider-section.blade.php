<section class="hero">
    @include('frontend.notice')

    @if (isset($homeslides) && count($homeslides) > 0)
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($homeslides as $index => $slide)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"
                        style="background-image: url({{ asset('uploads/' . $slide->image) }}); background-size: cover; background-position: center; height: 100vh; position: relative;">
                        <div class="hero-background-overlay"
                            style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(0,0,0,0.5); z-index: 1;">
                        </div>
                        <div class="container h-100" style="position: relative; z-index: 2;">
                            <div class="row align-items-center d-flex h-100">
                                <div class="col-md-7">
                                    <div class="block text-white px-3 px-md-4 py-3">
                                        <div class="divider-blue mb-3"></div>
                                        <h1 class="mb-3 mt-3">{{ $slide->title }}</h1>
                                        <p class="mb-4 text-left">{!! $slide->shortdesc !!}</p>

                                        @if ($index == 0)
                                            <div class="btn-container">
                                                <a href="{{ route('contact-us') }}" target="_blank"
                                                    class="btn btn-primary">
                                                    Contact Us <i class="icofont-simple-right ml-2"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"
                    style="filter: invert(1); width: 40px; height: 40px;"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"
                    style="filter: invert(1); width: 40px; height: 40px;"></span>
            </button>
        </div>
    @else
        <div class="fallback-content text-center text-white"
            style="height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #333;">
            <div>
                <h1>No Slides Available</h1>
                <p>Please check back later or contact support.</p>
            </div>
        </div>
    @endif
</section>


@push('styles')
    <style>
        .hero .carousel-item {
            height: 100vh;
        }

        @media (max-width: 768px) {
            .hero .carousel-item {
                height: 60vh !important;

            }

            .carousel-control-prev,
            .carousel-control-next {
                display: none;
            }

            .hero .container.h-100 {
                height: 100%;
                padding-top: 20px;
                padding-bottom: 20px;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .hero p {
                font-size: 1rem;
            }
        }
    </style>
@endpush
