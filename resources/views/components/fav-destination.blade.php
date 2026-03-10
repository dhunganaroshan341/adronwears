<section class="trending destination pb-6 bg-grey pt-9">
    <div class="container">
        <div class="section-title text-center mb-5 pb-2 w-50 mx-auto">
            <h2 class="m-0">Choose Your <span>Favourite Destination</span></h2>
        </div>

        <div class="trend-box">
            {{-- Nav Tabs --}}
            {{-- @dd($favouriteDestinationsByCountry) --}}
            <div class="price-navtab text-center mb-4">
                {{-- Nav Tabs --}}
                <ul class="nav nav-tabs">
                    @foreach ($favouriteDestinationsByCountry as $country)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab"
                                href="#{{ \Illuminate\Support\Str::slug($country->name) }}">
                                {{ $country->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Tab Contents --}}
            <div class="tab-content">
                @foreach ($favouriteDestinationsByCountry as $country)
                    <div id="{{ \Illuminate\Support\Str::slug($country->name) }}"
                        class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                        <div class="row">
                            @foreach ($country->favouritePackages as $package)
                                @php
                                    $slug = $package->slug ?? null;
                                    $routeUrl = $slug ? route('packages.show', $slug) : '#';
                                    $firstImage = $package->packageImages?->first();
                                    $imageUrl = $firstImage
                                        ? $firstImage->image_path
                                        : asset('template/yatri_world/main-file/images/everest.jpg');
                                @endphp
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="trend-item">
                                        <div class="trend-image">
                                            <img loading="lazy" src="{{ $imageUrl }}"
                                                alt="{{ $package->title ?? 'Package Image' }}">
                                        </div>
                                        <div class="trend-content-main">
                                            <div class="trend-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0">
                                                        <a
                                                            href="{{ $routeUrl }}">{{ $package->title ?? 'Untitled Package' }}</a>
                                                    </h4>
                                                    <span class="omundum-text-green fw-bold">
                                                        {{ $package->price ? '$' . $package->price : '' }}
                                                    </span>
                                                </div>

                                                <p class="mb-0">
                                                    <i class="fa fa-map-marker me-1 ms-3"></i>
                                                    {{ $country->name ?? 'Nepal' }}
                                                </p>
                                            </div>
                                            <div class="trend-last-main">
                                                <p class="mb-0 trend-para">
                                                    {{ \Illuminate\Support\Str::limit($package->short_description ?? '', 100) }}
                                                </p>
                                                <div
                                                    class="trend-last d-flex align-items-center justify-content-center">
                                                    <a href="{{ $routeUrl }}"
                                                        class="book-now-a mb-0 white d-flex align-items-center">
                                                        <img loading="lazy"
                                                            src="{{ $imageUrl ?? asset('template/yatri_world/main-file/images/india.jpg') }}"
                                                            class="d-author me-2" alt="Book Now Icon">
                                                        Book Now
                                                    </a>
                                                    <div class="trend-price">
                                                        <p class="price white mb-0">
                                                            <a href="{{ $routeUrl }}">
                                                                <i class="fa fa-arrow-right white ps-1"></i>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</section>
