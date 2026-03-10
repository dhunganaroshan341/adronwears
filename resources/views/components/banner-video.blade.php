<section class=" banner overflow-hidden position-relative">
    <video id="heroVideo" autoplay muted loop playsinline style="width: 100%; height: auto; object-fit: cover;">
        <source src="https://yourdomain.com/path-to-video/yourvideo.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
    <div class="container position-absolute top-50 start-50 translate-middle text-center text-white">
        <h1 class="mb-3">Closer to the heavens when Kailash calls.</h1>
        <p class="mb-4">Answer the call of Kailash — a sacred journey through majestic landscapes and inner
            transformation.</p>
        <a href="#" class="btn btn-light">Book Now</a>
    </div>
</section>
@push('scripts')
    <script>
        const video = document.getElementById("heroVideo");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) {
                video.muted = true; // optional if already muted
                video.pause(); // you can also use video.muted = true;
            } else {
                video.play();
            }
        });
    </script>
@endpush
