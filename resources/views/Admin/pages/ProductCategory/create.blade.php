@extends('Admin.layouts.master')

@section('content')
<div class="container">
    <x-admin.breadcrumb>
        <a href="route('admin.product-categories.index')" class="btn btn-outline-dark mb-3" data-bs-toggle="modal"><i
                class="fas-fa-arrow-left"></i> Back</a>

    </x-admin.breadcrumb>

    <form action="{{ route('product-categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Parent Category</label>
            <select name="parent_id" class="form-control">
                <option value="">-- None --</option>
                @foreach($parentCategories as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-outline-dark">Save</button>
    </form>
</div>
@endsection