@extends('Admin.layout.master')

@section('content')
<div class="container">

    <x-admin.breadcrumb>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">+ Add Product</a>
    </x-admin.breadcrumb>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <form method="GET">
                <div class="row g-2">

                    <div class="col-md-3 col-sm-6">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Search name / brand">
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <select name="category_id" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id ? 'selected' : '' }}>{{
                                $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-6">
                        <select name="stock" class="form-select">
                            <option value="">All Stock</option>
                            <option value="in" {{ request('stock')=='in' ? 'selected' : '' }}>In Stock</option>
                            <option value="out" {{ request('stock')=='out' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    <div class="col-md-1 col-6">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control"
                            placeholder="Min ₹">
                    </div>

                    <div class="col-md-1 col-6">
                        <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control"
                            placeholder="Max ₹">
                    </div>

                    <div class="col-md-1 col-6">
                        <select name="sort" class="form-select">
                            <option value="latest">Newest</option>
                            <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="price_low" {{ request('sort')=='price_low' ? 'selected' : '' }}>Price ↑
                            </option>
                            <option value="price_high" {{ request('sort')=='price_high' ? 'selected' : '' }}>Price ↓
                            </option>
                        </select>
                    </div>

                </div>

                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-sm btn-primary">Apply</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Actions --}}
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
        <a href="{{ route('admin.products.export') }}" class="btn btn-sm btn-outline-secondary">Export</a>

        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data"
            class="d-flex gap-2">
            @csrf
            <input type="file" name="file" required class="form-control form-control-sm" style="max-width: 200px">
            <button class="btn btn-sm btn-outline-secondary">Import</button>
        </form>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">

                <thead class="border-bottom">
                    <tr class="text-muted small">
                        <th class="fw-medium">#</th>
                        <th class="fw-medium">Name</th>
                        <th class="fw-medium">Category</th>
                        <th class="fw-medium">Price</th>
                        <th class="fw-medium">Status</th>
                        <th class="fw-medium" width="140">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="text-muted small">{{ $product->id }}</td>

                        <td>
                            <span class="fw-medium">{{ $product->name }}</span>
                            <br>
                            <small class="text-muted">{{ $product->brand }}</small>
                        </td>

                        <td class="text-muted small">{{ $product->category?->name }}</td>

                        <td>
                            <span class="fw-medium">₹{{ $product->price }}</span>
                            @if($product->sale_price)
                            <br><small class="text-danger">₹{{ $product->sale_price }}</small>
                            @endif
                        </td>

                        <td>
                            <span
                                class="badge rounded-pill bg-{{ $product->status == 'active' ? 'success' : 'secondary' }} bg-opacity-10 text-{{ $product->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>

                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger"
                                                onclick="return confirm('Delete this product?')">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links() }}
    </div>

</div>
@endsection