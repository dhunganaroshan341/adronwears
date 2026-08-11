@extends('Frontend.Layouts.main')

@section('title', 'Contact Us - Adron Fashion Wear')

@section('content')


{{-- Page Title --}}
<div class="py-5 container-fluid bg-light">
    <div class="m-auto text-center col-md-6">
        <h1 class="h1">Contact Us</h1>
        <p>
            Have questions? We'd love to hear from you.
            Send us a message and we'll respond as soon as possible.
        </p>
    </div>
</div>

{{-- ONE MAP ONLY --}}
<div id="mapid"></div>

{{-- Contact Info Section --}}
<div class="container py-4">
    <div class="text-center row">

        <div class="mb-4 col-md-4">
            <div class="border-0 shadow-sm card h-100">
                <div class="card-body">
                    <i class="mb-3 fas fa-map-marker-alt fa-3x text-success"></i>
                    <h5 class="card-title">Our Location</h5>
                    <p class="card-text text-muted">
                        {{ $contactInfo['address'] ?? 'Seti O.P. marga Koteshwor - Kathmandu , Nepal' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-4 col-md-4">
            <div class="border-0 shadow-sm card h-100">
                <div class="card-body">
                    <i class="mb-3 fas fa-phone-alt fa-3x text-success"></i>
                    <h5 class="card-title">Phone Number</h5>
                    <p class="card-text text-muted">
                        {{ $contactInfo['phone'] ?? '+977 9825056528' }}<br>
                        {{ $contactInfo['phone_alt'] ?? '+1 (555) 765-4321' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-4 col-md-4">
            <div class="border-0 shadow-sm card h-100">
                <div class="card-body">
                    <i class="mb-3 fas fa-envelope fa-3x text-success"></i>
                    <h5 class="card-title">Email Address</h5>
                    <p class="card-text text-muted">
                        {{ $contactInfo['email'] ?? 'info@adronfashionwear.com' }}<br>
                        {{ $contactInfo['email_alt'] ?? 'support@adronfashionwear.com' }}
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- YOUR EXISTING CONTACT FORM --}}
{{-- Keep your existing form here --}}

{{-- YOUR EXISTING BUSINESS HOURS --}}
{{-- Keep your existing business hours here --}}

{{-- YOUR EXISTING SOCIAL LINKS --}}
{{-- Keep your existing social links here --}}


@endsection

{{-- ========================================================= --}}
{{-- LEAFLET CSS - ONLY ONCE --}}
{{-- ========================================================= --}}

@push('styles')


<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin=""
>

<style>
    #mapid {
        width: 100%;
        height: 400px;
        z-index: 1;
    }

    .btn-social {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-social:hover {
        transform: translateY(-3px);
        background-color: #28a745;
        color: white;
    }

    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    @media (max-width: 768px) {
        #mapid {
            height: 300px;
        }

        .btn-social {
            width: 40px;
            height: 40px;
        }
    }
</style>


@endpush

{{-- ========================================================= --}}
{{-- LEAFLET JS - ONLY ONCE --}}
{{-- ========================================================= --}}

@push('scripts')


<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    crossorigin=""
></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const latitude = 27.679090595461183;
        const longitude = 85.34734579387128;

        const mapElement = document.getElementById('mapid');

        // Safety check
        if (!mapElement) {
            return;
        }

        const map = L.map(mapElement).setView(
            [latitude, longitude],
            16
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        }).addTo(map);

        L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup(`
                <strong>{{ $shopName ?? 'Adron Fashion Wear' }}</strong><br>
                {{ $shopAddress ?? 'Our Store Location' }}
            `)
            .openPopup();

        map.scrollWheelZoom.disable();
    });
</script>

@endpush
