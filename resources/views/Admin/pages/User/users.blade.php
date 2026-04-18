@extends('Admin.layout.master')
@section('content')
<div class="container-fluid">
    <x-admin.breadcrumb>
        <button type="button" class="btn btn-outline-dark  addUserButton" data-action="add">
            Add User
        </button>
    </x-admin.breadcrumb>
    <!-- Button trigger modal -->


    {{-- Table --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="show-user-data">
                        <thead>
                            <tr>
                                <th> S.N </th>
                                <th> Image </th>
                                <th> Full Name </th>
                                <th> Email </th>
                                <th> Position </th>
                                <th> Phone Number </th>
                                <th> Role </th>
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
    @include('Admin.pages.User.usermodal')
</div>
@endsection