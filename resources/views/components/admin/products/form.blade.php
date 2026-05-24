<div class="row g-3">

    {{-- LEFT: MAIN INFO --}}
    <div class="col-12 col-lg-8">

        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-3 p-md-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold mb-0">
                        Product Information
                    </h6>
                </div>

                <div class="row g-3">

                    {{-- PRODUCT NAME --}}
                    <div class="col-12 col-md-12">
                        <label class="form-label text-muted small">
                            Product Name
                        </label>

                        <input type="text" name="name" class="form-control" placeholder="Men's Oversized Cotton T-Shirt"
                            value="{{ old('name', $product->name ?? '') }}" required>
                    </div>



                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <label class="form-label text-muted small">
                            Description
                        </label>

                        <textarea rows="8" name="description" id="description-editor"
                            class="form-control">{{ old('description', $product->description ?? '') }}</textarea>

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
        <div class="card border-primary shadow-sm mb-3 sticky-top" style="top: 15px;">
            <div class="card-body">

                <div class="d-grid gap-2 d-md-flex flex-md-column">
                    {{ $formSubmitRightTop ?? '' }}
                </div>

            </div>
        </div>

        {{-- META --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-3 p-md-4">

                <h6 class="fw-semibold mb-3">
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

                            @foreach($categories as $category)

                            <option value="{{ $category->id }}" @selected(old('product_category_id', $product->
                                product_category_id ?? '') == $category->id)>

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

                            <option value="simple" @selected(old('type', $product->type ?? 'simple') == 'simple')>
                                Simple
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

                            @foreach($brands as $brand)

                            <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') ==
                                $brand->id)>

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

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body p-3 p-md-4">

                        {{-- THUMBNAIL --}}
                        <h6 class="fw-semibold mb-3">
                            Thumbnail
                        </h6>

                        <input type="file" name="thumbnail" class="form-control" accept="image/*"
                            onchange="previewImages(event, 'imagePreview')">

                        {{-- EXISTING THUMBNAIL --}}
                        @if(isset($product) && $product->thumbnail)

                        <div class="mt-3">

                            <img src="{{ $product->thumbnail }}" class="img-fluid rounded border w-100"
                                style="height:180px; object-fit:cover;">

                        </div>

                        @endif

                        <div class="row g-2 mt-3" id="imagePreview"></div>

                        {{-- PRODUCT IMAGES --}}
                        <h6 class="fw-semibold mb-3 mt-4">
                            Product Images
                        </h6>

                        <input type="file" name="images[]" class="form-control" multiple accept="image/*"
                            onchange="previewImages(event, 'imagePreview2')">

                        {{-- EXISTING IMAGES --}}
                        @if(isset($product) && $product->images->count())

                        <div class="row g-2 mt-3">

                            @foreach($product->images as $image)

                            <div class="col-6 col-md-4 col-lg-3">

                                <div class="border rounded p-2 h-100">

                                    <img src="{{ $image->image_path }}" class="img-fluid rounded w-100"
                                        style="height:100px; object-fit:cover;">

                                    <div class="form-check mt-2">

                                        <input class="form-check-input" type="checkbox" name="delete_images[]"
                                            value="{{ $image->id }}" id="delete_image_{{ $image->id }}">

                                        <label class="form-check-label small" for="delete_image_{{ $image->id }}">

                                            Remove

                                        </label>

                                    </div>

                                </div>

                            </div>

                            @endforeach

                        </div>

                        @endif

                        <div class="row g-2 mt-3" id="imagePreview2"></div>

                    </div>

                </div>

            </div>

            {{-- RIGHT : PRICING + SAVE --}}
            <div class="col-12 col-lg-4">

                {{-- PRICING --}}
                <div class="card border-0 shadow-sm mb-3">

                    <div class="card-body p-3 p-md-4">

                        <h6 class="fw-semibold mb-3">
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

                                    <option value="inactive" @selected(old('status', $product->status ?? '') ==
                                        'inactive')>
                                        Inactive
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SAVE SECTION --}}
                <div class="card border-primary shadow-sm sticky-top" style="top: 15px;">

                    <div class="card-body">

                        <div class="d-grid gap-2">
                            {{ $formSubmitEnd ?? '' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>