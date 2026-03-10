@extends('Admin.layout.master')

@section('content')
    <h4>Upload Banner Video</h4>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.banner.video.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="video" class="form-label">Select Video (mp4, ogg, webm)</label>
            <input type="file" name="video" id="video" accept="video/mp4,video/ogg,video/webm" class="form-control"
                required>
        </div>

        @if ($video && $video->type === 'upload')
            <div class="mb-3">
                <label>Current Video:</label>
                @php
                    $extension = pathinfo($video->url, PATHINFO_EXTENSION);
                    $mimeType = match (strtolower($extension)) {
                        'mp4' => 'video/mp4',
                        'webm' => 'video/webm',
                        'ogg' => 'video/ogg',
                        default => 'video/mp4', // fallback
                    };
                @endphp

                <video controls style="width: 100%; max-height: 400px; object-fit: cover;">
                    <source src="{{ asset($video->url) }}" type="{{ $mimeType }}">
                    Your browser does not support the video tag.
                </video>

            </div>
        @endif

        <button type="submit" class="btn btn-primary">Upload & Save</button>
    </form>
@endsection
