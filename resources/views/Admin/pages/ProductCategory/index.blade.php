@extends('Admin.layout.master')

@section('content')
<div class="container">
    <x-admin.breadcrumb>
        <button class="mb-3 btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#categoryModal"
            onclick="openCreateForm()">simple Add</button>
           <a href="{{ route('admin.v1-product-categories.create') }}"
   class="mb-3 btn btn-outline-dark">
    Add Advanced Category
</a>

    </x-admin.breadcrumb>

    {{-- 🔍 FILTER BAR --}}
    <div class="mb-3 border-0 shadow-sm card">
        <div class="py-2 card-body">

            <form method="GET">
                <div class="row g-2 align-items-center">

                    {{-- Search --}}
                    <div class="col-md-4 col-sm-6">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm" placeholder="Search category name">
                    </div>

                    {{-- Parent --}}
                    <div class="col-md-3 col-sm-6">
                        <select name="parent_id" class="form-control form-control-sm">
                            <option value="">All Categories</option>
                            <option value="none" {{ request('parent_id')=='none' ? 'selected' : '' }}>
                                Root Categories
                            </option>

                            @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ request('parent_id')==$parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="status" class="form-control form-control-sm">
                            <option value="">Status</option>
                            <option value="Active" {{ request('status')=='Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ request('status')=='Inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    {{-- Sort --}}
                    <div class="col-md-2 col-sm-6">
                        <select name="sort" class="form-control form-control-sm">
                            <option value="latest">Latest</option>
                            <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="name_asc" {{ request('sort')=='name_asc' ? 'selected' : '' }}>A → Z</option>
                            <option value="name_desc" {{ request('sort')=='name_desc' ? 'selected' : '' }}>Z → A
                            </option>
                        </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="gap-1 col-md-1 col-sm-12 d-flex">
                        <button class="btn btn-sm btn-outline-dark w-100">Go</button>
                        <a href="{{ route('admin.product-categories.index') }}"
                            class="btn btn-sm btn-outline-secondary w-100">
                            Reset
                        </a>
                    </div>

                </div>
            </form>

        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent?->name ?? '-' }}</td>

                    <td>
                        <span
                            class="p-2 text-large badge rounded-pill bg-{{ $category->status == \App\Enums\StatusEnum::ACTIVE ? 'light' : 'light' }} bg-opacity-10 text-{{ $category->status == \App\Enums\StatusEnum::ACTIVE ? 'success' : 'danger' }}">
                            {{ ucfirst($category->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#categoryModal"
                                        onclick="openEditForm({{$category->id}})">
                                        Edit
                                    </button>
                                </li>

                                <li>
                                    <form action="{{ route('admin.product-categories.destroy', $category->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="dropdown-item text-danger"
                                            onclick="return confirm('Delete this category?')">
                                            Delete
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $categories->links() }}
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="categoryModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="categoryForm" method="POST" action="{{ route('admin.product-categories.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="category_id" name="category_id">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Parent Category</label>
                            <select id="parent_id" name="parent_id" class="form-control">
                                <option value="">-- None --</option>
                                @foreach($parentCategories as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-dark" id="saveBtn">Save</button>
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openCreateForm() {
            document.getElementById('categoryForm').action = "{{ route('admin.product-categories.store') }}";
            document.getElementById('modalTitle').innerText = "Add Category";
            document.getElementById('category_id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('parent_id').value = '';
            document.getElementById('status').value = 'Active';
        }

        function openEditForm(category) {
            document.getElementById('categoryForm').action = `/admin/product-categories/${category.id}`;
            document.getElementById('modalTitle').innerText = "Edit Category";
            document.getElementById('category_id').value = category.id;
            document.getElementById('name').value = category.name;
            document.getElementById('parent_id').value = category.parent_id ?? '';
            document.getElementById('status').value = category.status;
        }

        // SweetAlert delete confirmation
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This will delete the category!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
    @endpush
