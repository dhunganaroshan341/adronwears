<section class="banner-slider-section" style="width: 100%; max-width: 100vw; overflow: hidden;">
    <div class="container-fluid px-0">
        @if ($video)
            @if ($video->type === 'iframe')
                <div style="position: relative; padding-bottom: 56.25%; height: 400px; overflow: hidden;">
                    {!! $video->url !!}
                </div>
                <style>
                    .banner-slider-section iframe {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        border: 0;
                    }
                </style>
            @elseif ($video->type === 'upload')
                <video controls style="width: 100%; height: 400px; object-fit: cover;">
                    <source src="{{ asset($video->url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        @else
            <p>No video available.</p>
        @endif
    </div>
</section>
