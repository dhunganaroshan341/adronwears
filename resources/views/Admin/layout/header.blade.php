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
<link rel="shortcut icon" href="{{$logo?? asset('front/images/logo.png') }}" />




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
<style>
    .sidebar {
        width: 260px;
        min-height: 100vh;
        background: #fff;
        border-right: 1px solid #eee;
        transition: .3s ease;
        overflow-y: auto;
    }

    .sidebar .nav {
        padding: 15px 10px;
    }

    .nav-category {
        padding: 14px 15px;
        font-size: 12px;
        text-transform: uppercase;
        color: #999;
        font-weight: 700;
    }

    .nav-item {
        margin-bottom: 4px;
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: 10px;
        color: #444;
        transition: .3s;
    }

    .nav-link:hover {
        background: #f5f5f5;
        color: #ca0008;
    }

    .menu-icon {
        margin-right: 10px;
        font-size: 20px;
    }

    .menu-arrow {
        margin-left: auto;
    }

    .sub-menu {
        padding-left: 20px;
    }

    .sub-menu .nav-link {
        padding: 10px;
        font-size: 14px;
    }


    .sidebar-toggle {
        position: fixed;
        left: 15px;
        top: 15px;
        width: 45px;
        height: 45px;
        border: none;
        border-radius: 8px;
        z-index: 1001;
        display: none;

        background: #ca0008;
        color: white;
    }


    .sidebar-overlay {

        position: fixed;
        inset: 0;

        background: rgba(0, 0, 0, .4);

        opacity: 0;
        visibility: hidden;

        transition: .3s;

        z-index: 998;

    }


    @media(max-width:991px) {

        .sidebar {

            position: fixed;

            top: 0;
            left: -280px;

            z-index: 999;

            height: 100vh;

            box-shadow: 0 0 30px rgba(0, 0, 0, .15);
        }


        .sidebar.show {
            left: 0;
        }


        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }


        .sidebar-toggle {
            display: block;
        }

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