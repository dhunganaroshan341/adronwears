<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title> {{ $title ?? 'Adron Wears' }} | Admin Panel </title>


<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>

{{--
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">

{{-- Font Awesome --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
{{-- Font Awesome --}}

<link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
<link rel="shortcut icon" href="{{ asset('front/images/logo.png') }}" />




{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Sweet Alert --}}
<!-- Then app.js -->
@vite(['resources/js/app.js'])
<script>
    window.appBaseUrl = "{{ env('APP_URL') }}";

</script>
<style>
    /* Remove underline from icon links inside the datatable */
    table.dataTable a.addItineraryBtn,
    table.dataTable a.viewItineraryBtn,
    table.dataTable a.addTourBatchBtn,
    table.dataTable a.viewTourBatchBtn,
    table.dataTable a.imageListPopup,
    table.dataTable a.editUploads {
        text-decoration: none !important;
        cursor: pointer;
    }

    /* Optional: On hover, keep color but no underline */
    table.dataTable a:hover {
        text-decoration: none !important;
    }

    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }
</style>

@isset($extraCs)
@foreach ($extraCs as $css)
{{--
<script src="{{ asset($cs) }}?v=0.3.1"></script> --}}
<link rel="stylesheet" href="{{ $css }}">
@endforeach
@endisset

@stack('styles')
