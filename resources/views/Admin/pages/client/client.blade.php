@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3 addClientButton" data-action="add">
            Add Client
        </button>

        {{-- Table --}}
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="show-client-data">
                            <thead>
                                <tr>
                                    <th> S.N </th>
                                    <th> Image </th>
                                    <th> Client Name </th>
                                    <th> Type </th>
                                    {{-- <th> Address </th>
                                    <th> Phone Number </th> --}}
                                    <th> Status </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{-- Table --}}

        <!-- Modal -->
        @include('Admin.pages.client.clientmodal')
    </div>
@endsection
