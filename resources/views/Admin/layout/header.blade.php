<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $title ?? 'Adron Wears' }} | Admin Panel</title>

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

<link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
<link rel="shortcut icon" href="{{ $logo ?? '' }}" />

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@vite(['resources/js/app.js'])

<script>
    window.appBaseUrl = "{{ config('app.url') }}";
</script>

<style>
    .offcanvas {
        z-index: 1055;
    }

    .sidebar {
        width: 260px;
    }

    @media (min-width: 992px) {
        .offcanvas-lg {
            transform: none !important;
            visibility: visible !important;
            position: static !important;
            width: 260px;
        }
    }
</style>




@isset($extraCs)
@foreach ($extraCs as $css)
<link rel="stylesheet" href="{{ $css }}">
@endforeach
@endisset

@stack('styles')