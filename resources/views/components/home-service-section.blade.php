<section class="section-3 py-5">
    <div class="container">
        <div class="divider mb-3"></div>
        <h2 class="title-color mb-4 h1">Services</h2>
        <div class="cards">
            <div class="row">
                @if (isset($services) && count($services) > 0)
                    @foreach ($services as $service)
                        <div class="col-md-4 mb-4">
                            <div class="card border-0">
                                @if (!empty($service->image))
                                    <img src="{{ asset('uploads/' . $service->image) }}" class="card-img-top"
                                        alt="">
                                @else
                                    <img src="{{ asset('assets/images/digital-marketing.jpg') }}" class="card-img-top"
                                        alt="">
                                @endif

                                <div class="card-body p-3">
                                    <h1 class="card-title mt-2">
                                        <a href="{{ route('service-detail', $service->id) }}">{{ $service->name }}</a>
                                    </h1>
                                    <div class="content pt-2">
                                        <p class="card-text">{{ $service->short_desc }}</p>
                                    </div>
                                    <a href="{{ route('service-detail', $service->id) }}"
                                        class="btn btn-primary mt-4 text-realm-blue">
                                        Details <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <h4>No services available at the moment.</h4>
                            <p>Please check back later or contact us for more information.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('service') }}" class="btn btn-secondary text-white">View All Services</a>
    </div>
</section>
