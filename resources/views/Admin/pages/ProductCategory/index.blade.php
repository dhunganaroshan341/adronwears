@extends('Admin.layout.master')

@section('content')
<div class="container">
    <h2>Product Categories</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#categoryModal"
        onclick="openCreateForm()">Add Category</button>

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
                    @if($category->status === \App\Enums\StatusEnum::ACTIVE)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#categoryModal"
                        onclick="openEditForm({{ $category }})">Edit</button>

                    <form action="{{ route('admin.product-categories.destroy', $category->id) }}" method="POST"
                        class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
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
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
