<div class="row g-3">

    {{-- LEFT: MAIN INFO --}}
    <div class="col-12 col-lg-8">

        <div class="border-0 shadow-sm card h-100">
            <div class="p-3 card-body p-md-4">

                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-semibold">
                        Product Information
                    </h6>
                </div>

                <div class="row g-3">

                    {{-- PRODUCT NAME --}}
                    <div class="col-12 col-md-12">
                        <label class="form-label text-muted small">
                            Product Name
                        </label>

                        <input type="text" name="name" class="form-control"
                            placeholder="Men's Oversized Cotton T-Shirt" value="{{ old('name', $product->name ?? '') }}"
                            required>
                    </div>



                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <label class="form-label text-muted small">
                            Description
                        </label>

                        <textarea rows="8" name="description" id="description-editor" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>

                        <div class="form-text">
                            Include fabric, fit, wash care, size guide, etc.
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- RIGHT SIDEBAR --}}
    <div class="col-12 col-lg-4">

        {{-- ACTIONS --}}
        <div class="mb-3 shadow-sm card border-primary sticky-top" style="top: 15px;">
            <div class="card-body">

                <div class="gap-2 d-grid d-md-flex flex-md-column">
                    {{ $formSubmitRightTop ?? '' }}
                </div>

            </div>
        </div>

        {{-- META --}}
        <div class="border-0 shadow-sm card">
            <div class="p-3 card-body p-md-4">

                <h6 class="mb-3 fw-semibold">
                    Product Meta
                </h6>

                <div class="row g-3">

                    {{-- CATEGORY --}}
                    <div class="col-12">

                        <label class="form-label text-muted small">
                            Category
                        </label>

                        <select name="product_category_id" class="form-select" required>

                            <option value="">
                                Select category
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('product_category_id', $product->product_category_id ?? '') == $category->id)>

                                    {{ $category->parent ? $category->parent->name . ' > ' : '' }}{{ $category->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>
                    {{-- TYPE --}}
                    <div class="col-6">
                        <label class="form-label text-muted small">
                            Type
                        </label>

                        <select name="type" class="form-select">
                             <option value="simple" @selected(old('type', $product->type ?? 'category_of_the_month') == 'category_of_the_month')>
                                Category of the Month
                            </option>
                            <option value="simple" @selected(old('type', $product->type ?? 'simple') == 'simple')>
                                Simple
                            </option>

                            <option value="bundle" @selected(old('type', $product->type ?? '') == 'featured')>
                                Featured
                            </option>
                            <option value="bundle" @selected(old('type', $product->type ?? '') == 'bundle')>
                                Bundle
                            </option>

                        </select>
                    </div>

                    {{-- BRAND --}}
                    <div class="col-6">

                        <label class="form-label text-muted small">
                            Brand
                        </label>

                        <select name="brand_id" class="form-select" required>

                            <option value="">
                                Select brand
                            </option>
                            <option value="general">General/Unknown</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') == $brand->id)>

                                    {{ $brand->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- GENDER --}}
                    <div class="col-12">

                        <label class="form-label text-muted small">
                            Gender
                        </label>

                        <select name="gender" class="form-select">

                            <option value="male" @selected(old('gender', $product->gender ?? '') == 'male')>
                                Male
                            </option>

                            <option value="female" @selected(old('gender', $product->gender ?? '') == 'female')>
                                Female
                            </option>

                        </select>

                    </div>

                </div>

            </div>
        </div>

    </div>



    {{-- BOTTOM SECTION --}}
    <div class="col-12">

        <div class="row g-3">

            {{-- LEFT : IMAGES --}}
            <div class="col-12 col-lg-8">

                <div class="border-0 shadow-sm card h-100">

                    <div class="p-3 card-body p-md-4">

                        {{-- THUMBNAIL --}}
                        <h6 class="mb-3 fw-semibold">
                            Thumbnail
                        </h6>

                        <input type="file" name="thumbnail" class="form-control" accept="image/*"
                            onchange="previewImages(event, 'imagePreview')">

                        {{-- EXISTING THUMBNAIL --}}
                        @if (isset($product) && $product->thumbnail)
                            <div class="mt-3">

                                <img src="{{ $product->thumbnail }}" class="border rounded img-fluid w-100"
                                    style="height:180px; object-fit:cover;">

                            </div>
                        @endif

                        <div class="mt-3 row g-2" id="imagePreview"></div>

                        {{-- PRODUCT IMAGES --}}
                        <h6 class="mt-4 mb-3 fw-semibold">
                            Product Images
                        </h6>

                        <input type="file" name="images[]" class="form-control" multiple accept="image/*"
                            onchange="previewImages(event, 'imagePreview2')">

                        {{-- EXISTING IMAGES --}}
                        @if (isset($product) && $product->images->count())

                            <div class="mt-3 row g-2">

                                @foreach ($product->images as $image)
                                    <div class="col-6 col-md-4 col-lg-3">

                                        <div class="p-2 border rounded h-100">

                                            <img src="{{ $image->image_path }}" class="rounded img-fluid w-100"
                                                style="height:100px; object-fit:cover;">

                                            <div class="mt-2 form-check">

                                                <input class="form-check-input" type="checkbox" name="delete_images[]"
                                                    value="{{ $image->id }}" id="delete_image_{{ $image->id }}">

                                                <label class="form-check-label small"
                                                    for="delete_image_{{ $image->id }}">

                                                    Remove

                                                </label>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>

                        @endif

                        <div class="mt-3 row g-2" id="imagePreview2"></div>

                    </div>

                </div>

            </div>

            {{-- RIGHT : PRICING + SAVE --}}
            <div class="col-12 col-lg-4">

                {{-- PRICING --}}
                <div class="mb-3 border-0 shadow-sm card">

                    <div class="p-3 card-body p-md-4">

                        <h6 class="mb-3 fw-semibold">
                            Pricing & Status
                        </h6>

                        <div class="row g-3">

                            {{-- PRICE --}}
                            <div class="col-12">

                                <label class="form-label text-muted small">
                                    Regular Price (₹)
                                </label>

                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="{{ old('price', $product->price ?? '') }}" required>

                            </div>

                            {{-- SALE PRICE --}}
                            <div class="col-12">

                                <label class="form-label text-muted small">
                                    Sale Price (₹)
                                </label>

                                <input type="number" step="0.01" name="sale_price" class="form-control"
                                    value="{{ old('sale_price', $product->sale_price ?? '') }}">

                            </div>

                            {{-- STATUS --}}
                            <div class="col-12">

                                <label class="form-label text-muted small">
                                    Status
                                </label>

                                <select name="status" class="form-select">

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

                {{-- SAVE SECTION --}}
                <div class="shadow-sm card border-primary sticky-top" style="top: 15px;">

                    <div class="card-body">

                        <div class="gap-2 d-grid">
                            {{ $formSubmitEnd ?? '' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
