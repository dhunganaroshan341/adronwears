@extends('Admin.layout.master')

@section('content')
<div class="container">

    {{-- ✅ Breadcrumb --}}
    <x-admin.breadcrumb>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
            + Add Product
        </a>
    </x-admin.breadcrumb>

    {{-- 🔍 Filters --}}
    <div class="card shadow-sm mb-3 border-0">
        <div class="card-body">

            <form method="GET">
                <div class="row g-2">

                    {{-- Search --}}
                    <div class="col-md-3 col-sm-6">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Search name / brand">
                    </div>

                    {{-- Category --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="category_id" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories ?? [] as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="status" class="form-control">
                            <option value="">Status</option>
                            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Stock --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="stock" class="form-control">
                            <option value="">Stock</option>
                            <option value="in" {{ request('stock')=='in' ? 'selected' : '' }}>In Stock</option>
                            <option value="out" {{ request('stock')=='out' ? 'selected' : '' }}>Out of Stock</option>
                        </select>
                    </div>

                    {{-- Price Min --}}
                    <div class="col-md-1 col-6">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" class="form-control"
                            placeholder="Min">
                    </div>

                    {{-- Price Max --}}
                    <div class="col-md-1 col-6">
                        <input type="number" name="max_price" value="{{ request('max_price') }}" class="form-control"
                            placeholder="Max">
                    </div>

                    {{-- Sort --}}
                    <div class="col-md-1 col-6">
                        <select name="sort" class="form-control">
                            <option value="latest">↓</option>
                            <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>↑</option>
                            <option value="price_low" {{ request('sort')=='price_low' ? 'selected' : '' }}>₹↓</option>
                            <option value="price_high" {{ request('sort')=='price_high' ? 'selected' : '' }}>₹↑</option>
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

    {{-- ⚙️ Actions --}}
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">

        <a href="{{ route('admin.products.export') }}" class="btn btn-sm btn-outline-success">
            Export
        </a>

        <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data"
            class="d-flex gap-2">
            @csrf
            <input type="file" name="file" required class="form-control form-control-sm" style="max-width:200px">
            <button class="btn btn-sm btn-outline-secondary">Import</button>
        </form>

    </div>

    {{-- 📦 Table --}}
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0 align-middle">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th width="140">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>

                        <td>
                            <strong>{{ $product->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $product->brand }}</small>
                        </td>

                        <td>{{ $product->category?->name }}</td>

                        <td>
                            ₹{{ $product->price }}
                            @if($product->sale_price)
                            <br>
                            <small class="text-danger">Sale: ₹{{ $product->sale_price }}</small>
                            @endif
                        </td>

                        <td>
                            <span class="badge bg-{{ $product->status == 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>

                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-sm btn-outline-warning"><i class="fas fa-pencil"></i></a>

                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    {{-- 🔢 Pagination --}}
    <div class="mt-3">
        {{ $products->links() }}
    </div>

</div>
@endsection