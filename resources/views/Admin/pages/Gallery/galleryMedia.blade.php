@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addBtn mb-4">Add Media</button>
        <div class="table-responsive">
            <table class="table table-striped custom-table" id="data-media-show">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">media</th>
                        <th scope="col">Album</th>
                        <th scope="col">type</th>
                        {{-- <th scope="col">Created At</th> --}}
                        <th scope="col">Status</th>

                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        @include('Admin.pages.Gallery.mediaModal')

    </div>
@endsection
