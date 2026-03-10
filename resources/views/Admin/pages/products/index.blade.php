@extends('Admin.layout.master')

@section('content')
<div class="container">
    <h3 class="mb-3">Products</h3>



    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Add Product
        </a>

        <a href="{{ route('admin.products.export') }}" class="btn btn-success">
            Export Excel
        </a>

        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" required class="form-control d-inline-block" style="width:220px">
            <button class="btn btn-secondary">Import</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th width="120">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category?->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ ucfirst($product->status) }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection
