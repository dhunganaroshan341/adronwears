@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addServiceBtn mb-4 mt-4">Add Services</button>
        @include('Admin.pages.Services.servicemodal')

        <div class="table-responsive">
            <table class="table table-striped" id="show-testimonial-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Short Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

@endsection
