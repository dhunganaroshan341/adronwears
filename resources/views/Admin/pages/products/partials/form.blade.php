<div class="row g-3">

    {{-- LEFT: MAIN INFO --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Product Information</h6>

                <div class="mb-3">
                    <label class="form-label text-muted small">Product Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Men's Oversized Cotton T-Shirt"
                        value="{{ old('name', $product->name ?? '') }}" required>
                </div>

                <div>
                    <label class="form-label text-muted small">Description</label>
                    <textarea name="description" id="description-editor"
                        class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
                    <div class="form-text">Include fabric, fit, wash care, size guide, etc.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT: META --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Product Meta</h6>

                <div class="mb-3">
                    <label class="form-label text-muted small">Category</label>
                    <select name="product_category_id" class="form-select" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('product_category_id', $product->
                            product_category_id ?? '') == $category->id)>
                            {{ $category->parent ? $category->parent->name . ' > ' : '' }}{{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small">Brand</label>
                    <select name="brand_id" class="form-select" required>
                        <option value="">Select brand</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') ==
                            $brand->id)>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label text-muted small">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="male" @selected(old('gender', $product->gender ?? '') == 'male')>Male</option>
                        <option value="female" @selected(old('gender', $product->gender ?? '') == 'female')>Female
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- PRICING --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Pricing & Status</h6>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Regular Price (₹)</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Sale Price (₹)</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control"
                            value="{{ old('sale_price', $product->sale_price ?? '') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label text-muted small">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" @selected(old('status', $product->status ?? '') == 'active')>Active
                            </option>
                            <option value="inactive" @selected(old('status', $product->status ?? '') ==
                                'inactive')>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- IMAGES --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Product Images</h6>
                <input type="file" name="images[]" class="form-control" multiple accept="image/*"
                    onchange="previewImages(event)">
                <div class="row mt-3" id="imagePreview"></div>
            </div>
        </div>
    </div>

</div>