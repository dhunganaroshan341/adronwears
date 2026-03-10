@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addTestimonialBtn mb-4 mt-4">Add Testimonial</button>
        @include('Admin.pages.TestiMonial.testimonialModal')

        <div class="table-responsive">
            <table class="table table-striped" id="show-testimonial-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        {{-- <th scope="col">Address</th> --}}
                        <th scope="col">Designation</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

@endsection
