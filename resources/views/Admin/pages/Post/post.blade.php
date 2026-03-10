@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addPostBtn mb-4">Add Post</button>
        @include('Admin.pages.Post.postModal')
        <div class="table-responsive">
            <table class="table table-striped custom-table" id="data-post-show">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Status</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection
