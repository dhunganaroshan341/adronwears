@extends('Admin.layout.master')
@section('content')
    {{-- <h1 class="text-center">Hello world</h1> --}}
    <div class="container-fluid ml-2">


        <button class="btn btn-primary addCategoryBtn">Add Category</button>
        @include('Admin.pages.Category.categoryModal')

        <div class="table-responsive mt-3">
            <table class="table table-striped" id="show-category-data">
                <thead>
                    <tr>
                        <th scope="col">S.N</th>
                        <th scope="col">Title</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>


    </div>

@endsection
