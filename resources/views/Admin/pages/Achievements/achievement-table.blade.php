@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <button class="btn btn-primary addAchievementBtn mb-4 mt-4">Add Achievement</button>
        @include('Admin.pages.Achievements.achievementModal')

        <div class="table-responsive">
            <table class="table table-striped" id="show-achievement-data">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>FontAwesome Icon</th>
                        <th>Title</th>
                        <th>Count</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
