<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">🧥 Product Information</h5>
        <small class="text-muted">Basic product details</small>
    </div>

    <div class="card-body">
        <div class="row g-3">

            <!-- Category -->
            <div class="col-md-4">
                <label class="form-label fw-semibold">Category</label>
                <select name="product_category_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('product_category_id', $product->
                        product_category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Product Name -->
            <div class="col-md-8">
                <label class="form-label fw-semibold">Product Name</label>
                <input type="text" name="name" class="form-control" placeholder="Men's Oversized Cotton T-Shirt"
                    value="{{ old('name', $product->name ?? '') }}" required>
            </div>

            <!-- Description -->
            <div class="col-12">
                <label class="form-label fw-semibold">Product Description</label>
                <textarea name="description" id="description-editor"
                    class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                <small class="text-muted">
                    Include fabric, fit, wash care, size guide, etc.
                </small>
            </div>

        </div>
    </div>
</div>

<!-- pricing and status -->

<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">💰 Pricing & Status</h5>
    </div>

    <div class="card-body">
        <div class="row g-3">

            <div class="col-md-3">
                <label class="form-label fw-semibold">Regular Price (₹)</label>
                <input type="number" step="0.01" name="price" class="form-control"
                    value="{{ old('price', $product->price ?? '') }}" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Sale Price (₹)</label>
                <input type="number" step="0.01" name="sale_price" class="form-control"
                    value="{{ old('sale_price', $product->sale_price ?? '') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-control">
                    <option value="active" @selected(old('status', $product->status ?? '') == 'active')>
                        Active
                    </option>
                    <option value="inactive" @selected(old('status', $product->status ?? '') == 'inactive')>
                        Inactive
                    </option>
                </select>
            </div>

        </div>
    </div>
</div>


<!-- file upload -->

<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">🖼️ Product Images</h5>
        <small class="text-muted">Upload multiple product images</small>
    </div>

    <div class="card-body">


        @if(isset($product) && $product->images->count())
        <div class="row mb-3" id="existingImages">
            @foreach($product->images as $image)
            <div class="col-md-3 mb-3" id="image-box-{{ $image->id }}">
                <div class="border rounded p-2 text-center position-relative">

                    <img src="{{ $image->url }}" class="img-fluid rounded" style="height:150px;object-fit:cover;">

                    <button type="button"
                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-image-btn"
                        data-id="{{ $image->id }}">
                        ✕
                    </button>

                </div>
            </div>
            @endforeach
        </div>
        @endif



        <input type="file" name="images[]" class="form-control" multiple accept="image/*"
            onchange="previewImages(event)">

        <div class="row mt-3" id="imagePreview"></div>
    </div>
</div>
