@if (isset($services) && $services->count())
    <section class="container py-5">
        @foreach ($services as $index => $service)
            @php
                $isEven = $index % 2 === 0;
                $aos = $isEven ? 'fade-right' : 'fade-left';
                $rowClass = $isEven ? '' : 'flex-md-row-reverse';
            @endphp

            <div class="row align-items-center mb-5 {{ $rowClass }}">
                <div class="col-md-6" data-aos="{{ $aos }}">
                    <img src="{{ $service->image ?? asset('template/yatri_world/main-file/images/default.jpg') }}"
                        class="img-fluid rounded shadow" alt="{{ $service->name ?? 'Service Image' }}">
                </div>
                <div class="col-md-6" data-aos="{{ $aos }}">
                    <h3 class="mb-3 service-title">{{ $service->name ?? 'Service Title' }}</h3>
                    <p>{!! $service->description ?? 'Default description for our amazing service goes here.' !!}</p>

                    @if ($loop->first)
                        <a href="{{ route('packages.index') }}" class="btn btn-view-packages mt-3">Explore <i
                                class="fa fa-arrow-right white ps-1"></i></a>
                    @endif
                </div>
            </div>
        @endforeach
    </section>
@else
    <section class="container py-5">
        <div class="text-center mb-5">
            <h2>Our Featured Services</h2>
            <p>We provide a wide range of travel and adventure experiences tailored just for you.</p>
        </div>

        @php
            $fallbacks = [
                [
                    'title' => 'Trekking Adventures',
                    'image' => asset('template/yatri_world/main-file/images/everest.jpg'),
                    'desc' => 'Explore the breathtaking trails of Nepal with our expert-guided trekking services.',
                ],
                [
                    'title' => 'Cultural Tours',
                    'image' => asset('template/yatri_world/main-file/images/tibet.jpg'),
                    'desc' =>
                        'Dive into Nepal’s rich culture and heritage. Visit temples, local villages, and unique traditions.',
                ],
                [
                    'title' => 'Local Transportation',
                    'image' => asset('template/yatri_world/main-file/images/everest.jpg'),
                    'desc' => 'Enjoy comfortable, safe, and reliable transport with our experienced drivers.',
                ],
                [
                    'title' => 'Emergency Support & Insurance',
                    'image' => asset('template/yatri_world/main-file/images/everest.jpg'),
                    'desc' => '24/7 emergency support, insurance help, and peace of mind throughout your trip.',
                ],
            ];
        @endphp

        @foreach ($fallbacks as $index => $fallback)
            @php
                $isEven = $index % 2 === 0;
                $aos = $isEven ? 'fade-right' : 'fade-left';
                $rowClass = $isEven ? '' : 'flex-md-row-reverse';
            @endphp

            <div class="row align-items-center mb-5 {{ $rowClass }}">
                <div class="col-md-6" data-aos="{{ $aos }}">
                    <img src="{{ $fallback['image'] }}" class="img-fluid rounded shadow"
                        alt="{{ $fallback['title'] }}">
                </div>
                <div class="col-md-6" data-aos="{{ $aos }}">
                    <h3 class="mb-3 service-title">{{ $fallback['title'] }}</h3>
                    <p>{{ $fallback['desc'] }}</p>
                    <a href="#" class="btn btn-view-packages mt-3">Learn More <i
                            class="fa fa-arrow-right white ps-1"></i></a>
                </div>
            </div>
        @endforeach
    </section>
@endif
@push('styles')
    <style>
        span {
            background: none !important;
        }
    </style>
@endpush
