@if ($randomPackages)

    <section class="top-destination overflow-hidden bg-navy p-0">
        <div class="container-fluid">
            <div class="desti-inner">
                @php
                    $fallbackImages = [
                        asset('template/yatri_world/main-file/images/india.jpg'),
                        asset('template/yatri_world/main-file/images/everest.jpeg'),
                        asset('template/yatri_world/main-file/images/destination/lumbini.jpg'),
                        asset('template/yatri_world/main-file/images/tibet.jpg'),
                        asset('template/yatri_world/main-file/images/bhutan.jpg'),
                        asset('template/yatri_world/main-file/images/tibet_vertical.jpg'),
                    ];

                    // Pick one random fallback image to use globally if package image missing
                    $randomFallback = $fallbackImages[array_rand($fallbackImages)];
                @endphp

                @foreach ($randomPackages->chunk(4) as $chunk)
                    <div class="row d-flex align-items-center">
                        @foreach ($chunk as $package)
                            <div class="col-lg p-0 position-relative">
                                <div class="desti-image bordernone">
                                    @php
                                        $imgSrc = $package->first_image_url ?? $randomFallback;
                                    @endphp
                                    <img loading="lazy" src="{{ $imgSrc }}"
                                        alt="{{ $package->title ?? 'Destination' }}">

                                    <div class="desti-content">
                                        @if ($package->duration != '0days' && $package->duration != '0 days')
                                            <button class="btn">
                                                <span class="badge badge-primary">{{ $package->duration ?? '' }}</span>
                                            </button>
                                        @endif

                                        @if ($package->batches_count > 0)
                                            <span class="badge badge-primary"
                                                style="padding: 9px; border-radius: 0%; background: rgba(97, 180, 136, 0.58);">
                                                {{ $package->batches_count }}
                                                {{ $package->batches_count > 1 ? 'Batches' : 'Batch' }}
                                            </span>
                                        @endif

                                        {{-- Most Booked Badge --}}
                                        @if ($package->most_booked)
                                            <span class="badge badge-primary"
                                                style="padding: 9px; border-radius: 0%; background: rgba(97, 180, 136, 0.58); margin-left: 5px;">
                                                Most Booked
                                            </span>
                                        @endif


                                        <h4 class="white mb-0">{{ $package->title ?? 'Tour Package' }}</h4>
                                    </div>
                                    <div class="desti-overlay">
                                        <a href="{{ route('packages.show', ['slug' => $package->slug]) }}"
                                            class="nir-btn">
                                            <span class="white">Book Now</span>
                                            <i class="fa fa-arrow-right white ps-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@else
    <section class="top-destination overflow-hidden bg-navy p-0">
        <div class="container-fluid">
            <div class="desti-inner">
                <div class="row d-flex align-items-center">
                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">

                            <img loading="lazy" src="{{ asset('template/yatri_world/main-file/images/tibet.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Mount Kailash Tour</h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy" src="{{ asset('template/yatri_world/main-file/images/bhutan.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Thimpu-City Bhutan</h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy" src="{{ asset('template/yatri_world/main-file/images/india.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">India Tour Package</h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy" src="{{ asset('template/yatri_world/main-file/images/tibet.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Mount kailash Premium </h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>



                <div class="row d-flex align-items-center">

                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy"
                                src="{{ asset('template/yatri_world/main-file/images/tibet_vertical.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Tibet Tour</h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy" src="{{ asset('template/yatri_world/main-file/images/india.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Northern India Tour</h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy"
                                src="{{ asset('template/yatri_world/main-file/images/tibet_vertical.jpg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Tibet package </h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg p-0">
                        <div class="desti-image bordernone">
                            <img loading="lazy"
                                src="{{ asset('template/yatri_world/main-file/images/everest.jpeg') }}"
                                alt="destination">
                            <div class="desti-content">
                                <div class="rating mb-1">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                </div>
                                <h4 class="white mb-0">Everest Base Camp </h4>
                            </div>
                            <div class="desti-overlay">
                                <a href="booking.html" class="nir-btn">
                                    <span class="white">Book Now</span>
                                    <i class="fa fa-arrow-right white ps-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>
@endif
