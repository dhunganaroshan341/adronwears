<div class="row g-3">

    {{-- ================= LEFT: MAIN INFO ================= --}}
    <div class="col-lg-8">

        {{-- Product Info --}}
        <div class="card shadow-sm mb-3 border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0">🧥 Product Information</h5>
                <small class="text-muted">Basic product details</small>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    {{-- Product Name --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Men's Oversized Cotton T-Shirt"
                            value="{{ old('name', $product->name ?? '') }}" required>
                    </div>

                    {{-- Description --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">Product Description</label>
                        <textarea name="description" id="description-editor" class="form-control">
                            {{ old('description', $product->description ?? '') }}
                        </textarea>
                        <small class="text-muted">
                            Include fabric, fit, wash care, size guide, etc.
                        </small>
                    </div>

                </div>
            </div>
        </div>



    </div>

    {{-- ================= RIGHT: META INFO ================= --}}
    <div class="col-lg-4">

        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">📦 Product Meta</h5>
            </div>

            <div class="card-body d-grid gap-3">

                {{-- Category --}}
                <div>
                    <label class="form-label fw-semibold">Category</label>
                    <select name="product_category_id" class="form-control" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('product_category_id', $product->
                            product_category_id ?? '') == $category->id)>

                            @if($category->parent)
                            {{ $category->parent->name }} >
                            @endif

                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Brand --}}
                <div>
                    <label class="form-label fw-semibold">Brand</label>
                    <select name="brand_id" class="form-control" required>
                        <option value="">-- Select Brand --</option>

                        @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') ==
                            $brand->id)>
                            {{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Gender --}}
                <div>
                    <label class="form-label fw-semibold">Gender</label>
                    <select name="gender" class="form-control">
                        <option value="male" @selected(old('gender', $product->gender ?? '') == 'male')>Male</option>
                        <option value="female" @selected(old('gender', $product->gender ?? '') == 'female')>Female
                        </option>
                    </select>
                </div>

            </div>
        </div>

    </div>

    {{-- ================= FULL WIDTH: PRICING ================= --}}
    <div class="col-8">

        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0">💰 Pricing & Status</h5>
            </div>

            <div class="card-body">
                <div class="row g-3">

                    {{-- Price --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Regular Price (₹)</label>
                        <input type="number" step="0.01" name="price" class="form-control"
                            value="{{ old('price', $product->price ?? '') }}" required>
                    </div>

                    {{-- Sale Price --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Sale Price (₹)</label>
                        <input type="number" step="0.01" name="sale_price" class="form-control"
                            value="{{ old('sale_price', $product->sale_price ?? '') }}">
                    </div>

                    {{-- Status --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-control">
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

    {{-- Images --}}
    <div class="card shadow-sm border-0 col-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">🖼️ Product Images</h5>
            <small class="text-muted">Upload multiple product images</small>
        </div>

        <div class="card-body">
            <input type="file" name="images[]" class="form-control" multiple accept="image/*"
                onchange="previewImages(event)">

            <div class="row mt-3" id="imagePreview"></div>
        </div>
    </div>

</div>