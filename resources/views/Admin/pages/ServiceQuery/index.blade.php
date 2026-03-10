@extends('Admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="table-responsive">
            <table class="table align-middle table-striped table-bordered table-hover" id="fetch-service-query-data">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        {{-- <th>Message</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        @include('Admin.pages.ServiceQuery.serviceQueryModal')
    </div>
@endsection
