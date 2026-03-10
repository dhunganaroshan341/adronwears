@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addHomeSlideBtn mb-2">Add HomeSlide</button>
        @include('Admin.pages.HomeSlide.homeSlideModal')

        <div class="table-responsive">
            <table class="table table-striped align-middle" id="show-homeSlide-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Link Text</th>
                        <th scope="col">Link Url</th>
                        <th scope="col">status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
