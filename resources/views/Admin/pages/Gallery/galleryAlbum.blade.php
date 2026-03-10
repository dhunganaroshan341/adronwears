@extends('Admin.layout.master')

@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addGalleryAlbumBtn mb-4" data-bs-toggle="modal" data-bs-target="#galleryAlbumModal">Add
            Gallery</button>

        {{-- Modal --}}

        @include('Admin.pages.Gallery.albumModal')

        <div class="table-responsive">
            <table class="table table-striped custom-table" id="data-album-show">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Gallery</th>
                        <th scope="col">Type</th>
                        <th scope="col">Client</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
