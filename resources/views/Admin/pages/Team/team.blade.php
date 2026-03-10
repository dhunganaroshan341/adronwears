@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">

        <!-- Add Team Button -->
        <button class="btn btn-primary addTeamBtn mb-4 mt-4">Add Team Member</button>

        <!-- Include Team Modal -->
        @include('Admin.pages.Team.teamModal')

        <!-- Team DataTable -->
        <div class="table-responsive">
            <table class="table table-striped" id="show-team-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Order</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection
