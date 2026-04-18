@extends('Frontend.Layouts.main')

@section('title', 'Contact Us - Adron Fashion Wear')

@section('content')

<!-- Page Title -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Contact Us</h1>
        <p>
            Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
        </p>
    </div>
</div>

<!-- Map -->
<div id="mapid" style="width:100%;height:400px;"></div>

<!-- Contact Info Section -->
<div class="container py-4">
    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-map-marker-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Our Location</h5>
                    <p class="card-text text-muted">
                        {{ $contactInfo['address'] ?? '123 Business Street, Suite 100<br>New York, NY 10001' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-phone-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Phone Number</h5>
                    <p class="card-text text-muted">
                        {{ $contactInfo['phone'] ?? '+1 (555) 123-4567' }}<br>
                        {{ $contactInfo['phone_alt'] ?? '+1 (555) 765-4321' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-envelope fa-3x text-success mb-3"></i>
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

<!-- Contact Form -->
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <h3 class="text-center mb-0">Send Us a Message</h3>
                    <p class="text-muted text-center mt-2">We'll get back to you within 24 hours</p>
                </div>
                <div class="card-body p-4">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> Please check the form below for errors.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" id="contactForm">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">Your Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="John Doe" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">Email Address <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="john@example.com" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="phone" class="form-label fw-bold">Phone Number</label>
                                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" placeholder="+1 (555) 123-4567" value="{{ old('phone') }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="subject" class="form-label fw-bold">Subject <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                    id="subject" name="subject" placeholder="How can we help?"
                                    value="{{ old('subject') }}" required>
                                @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">Message <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message"
                                name="message" rows="6" placeholder="Tell us what you're thinking..."
                                required>{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required {{
                                old('privacy') ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="privacy">
                                I agree to the <a href="#" class="text-success">privacy policy</a> and consent to being
                                contacted.
                            </label>
                            @error('privacy')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col text-end mt-2">
                                <button type="reset" class="btn btn-outline-secondary btn-lg px-4 me-2">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-outline-success btn-lg px-5" id="submitBtn">
                                    <i class="fas fa-paper-plane"></i> Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Business Hours Section -->
<div class="container py-4">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 bg-light">
                <div class="card-body p-4">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <i class="fas fa-clock fa-2x text-success mb-2"></i>
                            <h5>Business Hours</h5>
                            <p class="text-muted mb-0">
                                Monday - Friday: 9:00 AM - 8:00 PM<br>
                                Saturday: 10:00 AM - 6:00 PM<br>
                                Sunday: Closed
                            </p>
                        </div>
                        <div class="col-md-6">
                            <i class="fas fa-headset fa-2x text-success mb-2"></i>
                            <h5>Customer Support</h5>
                            <p class="text-muted mb-0">
                                24/7 Email Support<br>
                                Live Chat: Mon-Fri, 9AM-6PM<br>
                                <a href="mailto:support@adronfashionwear.com"
                                    class="text-success">support@adronfashionwear.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Social Media Links -->
<div class="container py-4 mb-5">
    <div class="row text-center">
        <div class="col-12">
            <h4 class="mb-3">Follow Us</h4>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ $socialLinks['facebook'] ?? '#' }}" class="btn btn-outline-success btn-social">
                    <i class="fab fa-facebook-f fa-lg"></i>
                </a>
                <a href="{{ $socialLinks['twitter'] ?? '#' }}" class="btn btn-outline-success btn-social">
                    <i class="fab fa-twitter fa-lg"></i>
                </a>
                <a href="{{ $socialLinks['instagram'] ?? '#' }}" class="btn btn-outline-success btn-social">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="{{ $socialLinks['linkedin'] ?? '#' }}" class="btn btn-outline-success btn-social">
                    <i class="fab fa-linkedin-in fa-lg"></i>
                </a>
                <a href="{{ $socialLinks['youtube'] ?? '#' }}" class="btn btn-outline-success btn-social">
                    <i class="fab fa-youtube fa-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* Map styling */
    #mapid {
        z-index: 1;
    }

    /* Social buttons */
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

    /* Form styling */
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    /* Card hover effects */
    .card {
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    /* Loading spinner for submit button */
    .btn-loading {
        pointer-events: none;
        opacity: 0.7;
    }

    /* Responsive adjustments */
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

@push('scripts')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    // Initialize map
    var map = L.map('mapid').setView([{{ $mapCoordinates['lat'] ?? '-23.013104' }}, { { $mapCoordinates['lng'] ?? '-43.394365' } }], { { $mapZoom ?? 13 } });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Add marker
    var marker = L.marker([{{ $mapCoordinates['lat'] ?? '-23.013104' }}, { { $mapCoordinates['lng'] ?? '-43.394365' } }]).addTo(map)
        .bindPopup("<b>{{ $shopName ?? 'Adron Fashion Wear' }}</b><br>{{ $shopAddress ?? '123 Business Street, New York, NY 10001' }}")
        .openPopup();

    // Disable scroll wheel zoom
    map.scrollWheelZoom.disable();

    // Form submission with loading state
    document.getElementById('contactForm')?.addEventListener('submit', function (e) {
        const submitBtn = document.getElementById('submitBtn');
        const originalText = submitBtn.innerHTML;

        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        submitBtn.disabled = true;

        // Reset after submission (form will submit normally)
        setTimeout(() => {
            // This runs if the form doesn't submit normally (AJAX fallback)
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 5000);
    });

    // Reset button confirmation
    document.querySelector('button[type="reset"]')?.addEventListener('click', function (e) {
        if (!confirm('Are you sure you want to reset the form?')) {
            e.preventDefault();
        }
    });

    // Character counter for message field
    const messageField = document.getElementById('message');
    if (messageField) {
        const charCounter = document.createElement('small');
        charCounter.className = 'text-muted float-end';
        charCounter.id = 'charCounter';
        messageField.parentNode.appendChild(charCounter);

        function updateCharCount() {
            const remaining = 1000 - messageField.value.length;
            charCounter.textContent = `${remaining} characters remaining`;
            if (remaining < 0) {
                charCounter.classList.add('text-danger');
            } else {
                charCounter.classList.remove('text-danger');
            }
        }

        messageField.addEventListener('input', updateCharCount);
        updateCharCount();
    }
</script>
@endpush