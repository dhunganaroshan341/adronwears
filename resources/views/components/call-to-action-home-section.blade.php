<!-- Call to action starts -->
<section class="call-to-action call-to-action1 pb-6 pt-10"
    style="background-image:url({{ asset('template/yatri_world/main-file/images/everest.jpg') }})">
    <div class="call-main">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-lg-6 mb-4">
                    <div class="action-content">
                        <h3 class="white mb-0 text-uppercase">
                            {{ $callToAction->sub_heading ?? 'Find next place to visit' }}</h3>
                        <h2 class="white call-name">{{ $callToAction->title ?? 'EXPLORE THE WORLD' }}</h2>
                        <p class="white mb-4">{!! $callToAction->description ??
                            'There are many variations of passages of. Lorem Ipsum available, but
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     the majority have suffered alteration in some form, by injected humour, or randomised
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     words which don’t look.' !!}</p>
                        <a href="{{ $callToAction->button_url ?? route('packages.index') }}"
                            class="nir-btn">{{ $callToAction->button_text ?? 'Explore Packages' }} <i
                                class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="video-button">
                        <img src="{{ $callToAction->image_url ?? asset('template/yatri_world/main-file/images/tibet.jpg') }}"
                            alt="">

                        <div class="call-button text-center">
                            <button type="button" class="play-btn custom-js-video-button"
                                data-video-id="{{ $callToAction->iframe ?? 'gCRNEJxDJKM?si=V1p-5lDXyEl1H_25' }}"
                                data-channel="youtube">
                                <i class="fa fa-play"></i>
                            </button>
                        </div>
                        <div class="video-figure"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-overlay" style="background: #162241 url({{ asset('images/dot-overlay.png') }}) repeat;">
    </div>
</section>
<!-- call to action Ends -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.custom-js-video-button').forEach(button => {
                button.addEventListener('click', function() {
                    let videoId = this.getAttribute('data-video-id');
                    if (videoId.includes('?')) {
                        videoId = videoId.split('?')[0];
                    }
                    const channel = this.getAttribute('data-channel');
                    if (channel !== 'youtube') {
                        alert('Video channel not supported');
                        return;
                    }

                    const videoUrl =
                        `https://www.youtube.com/embed/${videoId}?autoplay=1&controls=0&modestbranding=1&rel=0&fs=0&iv_load_policy=3&disablekb=1&playsinline=1&mute=0&showinfo=0`;

                    const modal = document.createElement('div');
                    Object.assign(modal.style, {
                        position: 'fixed',
                        top: '50%',
                        left: '50%',
                        transform: 'translate(-50%, -50%)',
                        width: '90vw',
                        maxWidth: '800px',
                        aspectRatio: '16 / 9',
                        backgroundColor: 'black',
                        zIndex: 10000,
                        boxShadow: '0 0 15px rgba(0,0,0,0.5)',
                        borderRadius: '8px',
                        overflow: 'hidden',
                    });

                    modal.innerHTML = `
                <iframe
                    width="100%" height="100%"
                    src="${videoUrl}"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                    allow="autoplay"
                ></iframe>
                <button
                    style="
                        position:absolute;
                        top:10px;
                        right:15px;
                        font-size:28px;
                        color:#fff;
                        background:none;
                        border:none;
                        cursor:pointer;
                        z-index:10001;
                    "
                    aria-label="Close video"
                >&times;</button>
            `;

                    document.body.appendChild(modal);

                    modal.querySelector('button').addEventListener('click', () => {
                        document.body.removeChild(modal);
                    });

                    modal.addEventListener('click', (e) => {
                        if (e.target === modal) {
                            document.body.removeChild(modal);
                        }
                    });
                });
            });
        });
    </script>
@endpush
