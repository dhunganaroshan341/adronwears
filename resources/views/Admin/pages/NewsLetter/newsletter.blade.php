@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-info addTestimonialBtn mb-4 mt-4">NewsLetter Subscribers</button>

        <div class="table-responsive">
            <table class="table table-striped" id="show-newsletter-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Email</th>
                        <th scope="col">Submitted Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>

        </div>

    </div>
@endsection
