<section class="news pb-2 bg-lgrey pt-9">
    <div class="container">
        <div class="section-title text-center mb-5 pb-2 w-50 mx-auto">
            <h2 class="m-0">Latest <span>Blogs </span></h2>
            <p class="mb-0">
                Travel has helped us to understand the meaning of life and it has helped us become
                better people. Each time we travel, we see the world with new eyes.
            </p>
        </div>
        <div class="news-outer">
            <div class="row">
                {{-- First Post Large Left --}}
                @if ($posts->isNotEmpty())
                    @php
                        $firstPost = $posts->first();
                    @endphp
                    <div class="col-lg-5 mb-4">
                        <div class="news-item overflow-hidden">
                            <div class="news-image">
                                <a href="{{ route('blog.detail', ['slug' => $firstPost->slug]) }}">
                                    <img loading="lazy"
                                        src="{{ $firstPost->first_image_url ?? asset('template/yatri_world/main-file/images/india.jpg') }}"
                                        alt="image"></a>
                            </div>
                            <div class="news-list mt-2 border-b pb-2 mb-2">
                                <ul>
                                    <li>
                                        <a href="#" class="pe-3">
                                            <i class="fa fa-calendar pink pe-1"></i>
                                            {{ $firstPost->created_at->format('jS M Y') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="pe-3">
                                            {{-- <i class="fa fa-comment pink pe-1"></i> You can add comments count if available --}}
                                            {{-- {{ $firstPost->comments->count() ?? 0 }} --}}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="">
                                            <i class="fa fa-tag pink pe-1"></i>
                                            {{ $firstPost->category?->title ?? 'Travel' }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="news-content mt-2">
                                <h4 class="pb-2 mb-2 border-b">
                                    <a
                                        href="{{ route('blog.detail', ['slug' => $firstPost->slug]) }}">{{ $firstPost->title }}</a>
                                </h4>
                                <p class="mb-3">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($firstPost->description ?? ''), 600) !!}
                                </p>

                                {{-- Author info, if needed --}}
                                {{-- @if ($firstPost->createdBy)
                                    <div class="author-img">
                                        <img  loading="lazy" src="{{ $firstPost->createdBy->profile_photo_url ?? asset('template/yatri_world/main-file/images/default-user.png') }}"
                                            alt="Author Image">
                                        <span>By - {{ $firstPost->createdBy->name }}</span>
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Next Four Posts Smaller Right --}}
                <div class="col-lg-7 mb-4">
                    <div class="row">
                        @foreach ($posts->skip(1)->take(4) as $post)
                            <div class="col-md-6 mb-4">
                                <div class="news-item overflow-hidden">
                                    <div class="news-image">
                                        <a href="{{ route('blog.detail', ['slug' => $post->slug]) }}">
                                            <img loading="lazy"
                                                src="{{ $post->first_image_url ?? asset('template/yatri_world/main-file/images/default.jpg') }}"
                                                alt="image"></a>
                                    </div>
                                    <div class="news-list mt-2 border-b pb-2 mb-2">
                                        <ul>
                                            <li>
                                                <a href="#" class="pe-3">
                                                    <i class="fa fa-calendar pink pe-1"></i>
                                                    {{ $post->created_at->format('jS M Y') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="pe-3">
                                                    {{-- <i class="fa fa-comment pink pe-1"></i> Add comment count if needed --}}
                                                    {{-- {{ $post->comments->count() ?? 0 }} --}}
                                                </a>
                                            </li>
                                            <li>
                                                @foreach ($post->categories as $category)
                                                    <a href="#" class="me-2">
                                                        <i class="fa fa-tag pink pe-1"></i> {{ $category->title }},
                                                    </a>
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="news-content mt-2">
                                        <h4 class="bordernone mb-0">
                                            <a
                                                href="{{ route('blog.detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@push('styles')
    <style>
        .news-content h4 a:hover {
            color: var(--omundum-green);
            text-decoration: none;
            /* optional: remove underline on hover */
        }

        /* Make the main container flex and stretch items */
        .news-outer>.row {
            display: flex;
            align-items: stretch;
            /* stretch columns to equal height */
        }

        /* Left large post - stretch to fill */
        .news-outer>.row>.col-lg-5 {
            display: flex;
            flex-direction: column;
        }

        /* Right posts wrapper - full height */
        .news-outer>.row>.col-lg-7 {
            display: flex;
            flex-direction: column;
        }

        /* Inner row containing 4 smaller posts */
        .news-outer>.row>.col-lg-7>.row {
            flex-grow: 1;
        }

        /* Each small post */
        .news-outer .news-item {
            height: 100%;
            /* fill the col height */
            display: flex;
            flex-direction: column;
        }

        /* Make images scale nicely */
        .news-image img {
            object-fit: cover;
            width: 100%;
            height: 200px;
            /* or adjust based on design */
        }

        /* Adjust content section inside post to flex-grow */
        .news-content {
            flex-grow: 1;
        }
    </style>
@endpush
