@extends('Admin.layout.master')
@push('styles')
<style>
    .deleteData{
        display: none;
    }
</style>

@endpush
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary  mb-4 mt-4">Page Banners</button>
        @include('Admin.pages.PageBanner.pageBannerModal')

        <div class="table-responsive">
            <table class="table table-striped" id="show-page-banner-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Page</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Section</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        {{-- <th scope="col">Description</th> --}}
                    </tr>
                </thead>
            </table>
        </div>

    </div>

@endsection
