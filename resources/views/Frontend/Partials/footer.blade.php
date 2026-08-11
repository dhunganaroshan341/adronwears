<!-- Start Footer -->
<!-- Start Footer -->
<footer class="pt-5 bg-dark text-light" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <!-- Store Info -->
            <div class="mb-4 col-md-4">
                <h2 class="pb-3 h4 text-success border-bottom border-light">
                    Adron Fashion Wear
                </h2>

                <p class="mt-3">
                    Trusted fashion destination in Koteshwor-32, Kathmandu, Nepal.
                    Serving customers for over 7 years with trendy and classic styles.
                </p>

                <ul class="mt-3 list-unstyled footer-link-list">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Koteshwor-32, Kathmandu, Nepal
                    </li>
                    <li class="mb-2">
                        <i class="fa fa-phone me-2"></i>
                        <a class="text-light text-decoration-none" href="tel:+977XXXXXXXXX">
                        +977    {{ $contact??'9825056528' }}
                        </a>
                    </li>
                    <li>
                        <i class="fa fa-envelope me-2"></i>
                        <a class="text-light text-decoration-none" href="mailto:info@adronfashion.com">
                            {{ $email??'info@adronfashion.com' }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="mb-4 col-md-4">
                <h2 class="pb-3 h4 text-light border-bottom border-light">
                    Quick Links
                </h2>

                <ul class="mt-3 list-unstyled footer-link-list">
                    <li class="mb-2">
                        <a class="text-light text-decoration-none" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="mb-2">
                        <a class="text-light text-decoration-none" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="mb-2">
                        <a class="text-light text-decoration-none" href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    <li class="mb-2">
                        <a class="text-light text-decoration-none" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>

            <!-- Products / Categories -->
            <div class="mb-4 col-md-4">
                <h2 class="pb-3 h4 text-light border-bottom border-light">
                    Our Collections
                </h2>

                <ul class="mt-3 list-unstyled footer-link-list">
                    <li class="mb-2">Men's Wear</li>
                    <li class="mb-2">Women's Wear</li>
                    <li class="mb-2">Trendy Fashion</li>
                    <li class="mb-2">Classic & Formal Wear</li>
                    <li class="mb-2">Accessories</li>
                    <li>Bulk & Wholesale Orders</li>
                </ul>
            </div>

        </div>

        <!-- Social Media -->
        <div class="pt-4 mt-3 row border-top border-light">
            <div class="mb-3 text-center col-md-6 text-md-start mb-md-0">
                <p class="mb-0">
                    &copy; {{ now()->year }} Adron Fashion Wear. All rights reserved.
                </p>
            </div>

            <div class="text-center col-md-6 text-md-end">
                <a class="text-light me-3" target="_blank" href="{{$facebook??'#' }}">
                    <i class="fab fa-facebook-f fa-lg"></i>
                </a>
                <a class="text-light me-3" target="_blank" href="{{ $instagram??" #" }}">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a class="text-light me-3" target="_blank" href="{{ $tiktok??'#' }}">
                    <i class="fab fa-tiktok fa-lg"></i>
                </a>
                {{-- <a class="text-light" target="_blank" href="#">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a> --}}
            </div>
        </div>

    </div>
</footer>
<!-- End Footer -->
<!-- End Footer -->

<!-- Start Script -->
<script src="{{ asset('fashion-shop-template/assets/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('fashion-shop-template/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('fashion-shop-template/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('fashion-shop-template/assets/js/templatemo.js') }}"></script>
<script src="{{ asset('fashion-shop-template/assets/js/custom.js') }}"></script>
<!-- End Script -->
@stack('scripts')
</body>

</html>
